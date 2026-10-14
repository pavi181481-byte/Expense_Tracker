<?php

session_start();

require_once __DIR__ . "/config/db.php";

// Check login
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$transactionId = $_GET["id"] ?? null;

// Check transaction ID
if (!$transactionId) {
    header("Location: dashboard.php");
    exit;
}

// Delete transaction belonging to this user
$pool->execute(
    "DELETE FROM transactions
     WHERE id = ? AND user_id = ?",
    [
        $transactionId,
        $userId
    ]
);

// Return to dashboard
header("Location: dashboard.php");
exit;
?>