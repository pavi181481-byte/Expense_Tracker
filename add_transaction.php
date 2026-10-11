<?php

session_start();

require_once __DIR__ . '/config/db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userId = $_SESSION["user_id"];
    $type = $_POST["type"];
    $category = $_POST["category"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    $pool->execute(
        "INSERT INTO transactions
        (user_id, type, category, amount, description)
        VALUES (?, ?, ?, ?, ?)",
        [
            $userId,
            $type,
            $category,
            $amount,
            $description
        ]
    );

    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Transaction</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<h1>Student Expense Tracker</h1>

<h2>Add Transaction</h2>

<form method="post">

    <label>Type:</label><br>

    <select name="type" required>

        <option value="income">Income</option>
        <option value="expense">Expense</option>

    </select>

    <br><br>

    <label>Category:</label><br>

    <select name="category" required>

        <option value="Food">Food</option>
        <option value="Travel">Travel</option>
        <option value="Books">Books</option>
        <option value="Hostel">Hostel</option>
        <option value="Entertainment">Entertainment</option>
        <option value="Education">Education</option>
        <option value="Other">Other</option>

    </select>

    <br><br>

    <label>Amount:</label><br>

    <input
        type="number"
        name="amount"
        step="0.01"
        min="0"
        required
    >

    <br><br>

    <label>Description:</label><br>

    <input
        type="text"
        name="description"
        placeholder="Example: Lunch"
        required
    >

    <br><br>

    <button type="submit">
        Add Transaction
    </button>

</form>

<br>

<a href="dashboard.php">Back to Dashboard</a>

</body>

</html>