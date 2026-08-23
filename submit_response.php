<?php
header('Content-Type: application/json');
require_once 'db.php';

// OPTIONAL: Drop your Discord Webhook API URL inside the quotes below to receive smartphone alerts instantly
define('DISCORD_WEBHOOK_URL', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vibe = $_POST['vibe'] ?? '';
    $food = $_POST['food'] ?? '';
    $date_time = $_POST['date_time'] ?? '';

    if (!empty($vibe) && !empty($food) && !empty($date_time)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO responses (vibe, food, date_time) VALUES (?, ?, ?)");
            $stmt->execute([$vibe, $food, $date_time]);

            // Discord Webhook Dispatch Configuration
            if (defined('DISCORD_WEBHOOK_URL') && !empty(DISCORD_WEBHOOK_URL)) {
                $msg = [
                    "content" => "💖 **THEY SAID YES!** 💖\n✨ *Vibe:* {$vibe}\n🍕 *Food:* {$food}\n📅 *Time:* {$date_time}"
                ];
                $ch = curl_init(DISCORD_WEBHOOK_URL);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($msg));
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_exec($ch);
                curl_close($ch);
            }

            echo json_encode(['status' => 'success', 'message' => 'Response recorded securely']);
            exit;
        } catch (\PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database storage exception structure']);
            exit;
        }
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid Request Parameter mapping']);
exit;