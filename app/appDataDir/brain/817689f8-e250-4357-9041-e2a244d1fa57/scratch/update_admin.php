<?php

$configs = [
    ['host' => '127.0.0.1', 'port' => 8889, 'user' => 'root', 'pass' => 'root'],
    ['host' => '127.0.0.1', 'port' => 3306, 'user' => 'root', 'pass' => 'root'],
    ['host' => '127.0.0.1', 'port' => 3306, 'user' => 'root', 'pass' => ''],
    ['host' => 'localhost', 'port' => 3306, 'user' => 'root', 'pass' => 'root'],
];

$connected = false;
foreach ($configs as $config) {
    echo "Trying {$config['host']}:{$config['port']}... ";
    $mysqli = @new mysqli($config['host'], $config['user'], $config['pass'], 'summerbet_v47', $config['port']);
    if (!$mysqli->connect_error) {
        echo "Connected!\n";
        $connected = true;
        break;
    }
    // Try summerbwt_v47 as well
    $mysqli = @new mysqli($config['host'], $config['user'], $config['pass'], 'summerbwt_v47', $config['port']);
    if (!$mysqli->connect_error) {
        echo "Connected (to summerbwt_v47)!\n";
        $connected = true;
        break;
    }
    echo "Failed.\n";
}

if (!$connected) {
    die("Could not connect to any database configuration.\n");
}

$email = 'contact@summerbwt.fr';
$newPassword = 'SummerBWT@Admin_2026!';
$hashedPassword = md5($newPassword);

$sql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email' AND is_admin = 1";
$mysqli->query($sql);

if ($mysqli->affected_rows > 0) {
    echo "Password updated successfully for $email\n";
} else {
    $sql = "SELECT id, is_admin FROM users WHERE email = '$email'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    
    if ($user) {
        $sql = "UPDATE users SET password = '$hashedPassword', is_admin = 1 WHERE email = '$email'";
        $mysqli->query($sql);
        echo "Password updated and user promoted to admin.\n";
    } else {
        $now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO users (email, password, is_admin, firstname, created_date) VALUES ('$email', '$hashedPassword', 1, 'Admin', '$now')";
        if ($mysqli->query($sql)) {
            echo "New admin user created successfully.\n";
        } else {
            echo "Error: " . $mysqli->error . "\n";
        }
    }
}
$mysqli->close();
