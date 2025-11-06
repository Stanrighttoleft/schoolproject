<?php
if(!isset($_SESSION)) session_start();
require_once('Connections/conn_db.php');
require_once('php_lib.php');

header('Content-Type: application/json');

if(!isset($_POST['email'])){
    echo json_encode(['success'=>false,'message'=>'Email is required']);
    exit;
}

$email = trim($_POST['email']);

// Check if email exists
$sql = "SELECT name FROM member WHERE email=?";
$stmt = $link->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){
    echo json_encode(['success'=>false,'message'=>'Email not found']);
    exit;
}

// Generate token & expiry
$token = bin2hex(random_bytes(32));
$expire_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Insert or update token
$sql2 = "REPLACE INTO password_resets (email, token, expire_at) VALUES (?, ?, ?)";
$stmt2 = $link->prepare($sql2);
$stmt2->execute([$email, $token, $expire_at]);

// Prepare email
$reset_link = "https://yourdomain.com/reset_password.php?token=".$token;
$subject = "Password Reset Request";
$message = "Hi ".$user['name'].",\n\nClick the link to reset your password:\n".$reset_link."\n\nThis link expires in 1 hour.";
$headers = "From: no-reply@yourdomain.com\r\n";

if(mail($email, $subject, $message, $headers)){
    echo json_encode(['success'=>true,'message'=>'Reset link sent to your email.']);
} else {
    echo json_encode(['success'=>false,'message'=>'Failed to send email.']);
}
