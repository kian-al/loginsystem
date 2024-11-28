<?php
session_start();

$file = 'db-users.json'; 

$action = $_GET['action'] ?? '';
$data = json_decode(json: file_get_contents(filename: 'php://input'), associative: true);

if ($action === 'signup') {
    $username = $data['username'];
    $password = $data['password'];

    $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            echo json_encode(['message' => 'Username already exists.']);
            exit;
        }
    }

    $users[] = [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
    echo json_encode(['message' => 'Sign up successful.']);
    exit;
}

if ($action === 'login') {
    $username = $data['username'];
    $password = $data['password'];

    $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username; 
            echo json_encode(['success' => true]);
            exit;
        }
    }

    echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
    exit;
}
?>

 