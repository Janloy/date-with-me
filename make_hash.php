<?php
require_once 'db.php';

$username = 'admin';
$password = 'password123';

// This forces your native PHP engine to generate its own perfect cryptographic hash
$secure_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $secure_hash]);
    
    echo "<h2>Success! 🔐</h2>";
    echo "Your server successfully generated its own secure hash and saved it!<br><br>";
    echo "<b>Generated Hash:</b> " . htmlspecialchars($secure_hash) . "<br><br>";
    echo "Go back to <a href='admin_login.php'>admin_login.php</a> and log in now.";
} catch (\PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>