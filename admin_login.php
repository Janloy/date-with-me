<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin) {
                if (password_verify($password, $admin['password'])) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['user_id'] = $admin['id'];
                    
                    header("Location: admin.php");
                    exit;
                } else {
                    $error = "Password verification failed! (The password typed does not match the securely saved hash encryption string).";
                }
            } else {
                $error = "The username account could not be found inside the directory mapping.";
            }
        } catch (\PDOException $e) {
            $error = "Database Connection Exception: " . $e->getMessage();
        }
    } else {
        $error = "All credential data fields must be populated.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Gateway</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="card active" style="max-width: 380px; margin: auto;">
        <h2>Admin Gateway</h2>
        
        <?php if(!empty($error)): ?>
            <div style="background: rgba(255,0,0,0.08); color: #d90429; padding: 12px; border-radius: 10px; margin-bottom: 18px; font-size: 13px; text-align: left; line-height: 1.4;">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="admin_login.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-submit">Open Panel</button>
        </form>
    </div>
</body>
</html>