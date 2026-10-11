<?php

session_start();

require_once __DIR__ . '/config/db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: dashboard.php");
    exit;
}

// Get transaction
$result = $pool->execute(
    "SELECT * FROM transactions
     WHERE id = ? AND user_id = ?",
    [$id, $userId]
);

$transaction = $result->fetchRow();

if (!$transaction) {
    die("Transaction not found.");
}

// Update transaction
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $type = $_POST["type"];
    $category = $_POST["category"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    $pool->execute(
        "UPDATE transactions
         SET type = ?, category = ?, amount = ?, description = ?
         WHERE id = ? AND user_id = ?",
        [
            $type,
            $category,
            $amount,
            $description,
            $id,
            $userId
        ]
    );

    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Transaction</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<h1>Student Expense Tracker</h1>

<h2>Edit Transaction</h2>

<form method="post">

    <label>Type:</label><br>

    <select name="type" required>

        <option value="income"
            <?php if ($transaction["type"] === "income") echo "selected"; ?>>
            Income
        </option>

        <option value="expense"
            <?php if ($transaction["type"] === "expense") echo "selected"; ?>>
            Expense
        </option>

    </select>

    <br><br>

    <label>Category:</label><br>

    <select name="category" required>

        <?php
        $categories = [
            "Food",
            "Travel",
            "Books",
            "Hostel",
            "Entertainment",
            "Education",
            "Other"
        ];

        foreach ($categories as $category):
        ?>

            <option value="<?php echo $category; ?>"
                <?php if ($transaction["category"] === $category) echo "selected"; ?>>

                <?php echo $category; ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <label>Amount:</label><br>

    <input
        type="number"
        name="amount"
        value="<?php echo $transaction["amount"]; ?>"
        step="0.01"
        min="0"
        required
    >

    <br><br>

    <label>Description:</label><br>

    <input
        type="text"
        name="description"
        value="<?php echo htmlspecialchars($transaction["description"]); ?>"
        required
    >

    <br><br>

    <button type="submit">
        Update Transaction
    </button>

</form>

<br>

<a href="dashboard.php">Back to Dashboard</a>

</body>

</html>