<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM responses ORDER BY created_at DESC");
$responses = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Admin Insights Panel</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fff5f8; padding: 40px; color: #2b2d42; }
        .dashboard-container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 14px; text-align: left; border-bottom: 1px solid #ffe3ed; }
        th { background-color: #ff477e; color: white; border-radius: 6px; font-weight: 600; }
        tr:hover { background-color: #fffafd; }
        .logout { float: right; color: #ff477e; font-weight: bold; text-decoration: none; border: 2px solid #ff477e; padding: 6px 16px; border-radius: 20px; transition: all 0.2s; }
        .logout:hover { background: #ff477e; color: white; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <a href="logout.php" class="logout">Logout Session</a>
        <h2>Date Proposal Submissions 💕</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Vibe Preference</th>
                <th>Food Preference</th>
                <th>Proposed Date/Time</th>
                <th>Submitted On</th>
            </tr>
            <?php foreach($responses as $row): ?>
            <tr>
                <td><b>#<?= htmlspecialchars($row['id']) ?></b></td>
                <td><?= htmlspecialchars($row['vibe']) ?></td>
                <td><?= htmlspecialchars($row['food']) ?></td>
                <td><?= htmlspecialchars($row['date_time']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>