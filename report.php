<?php

session_start();

require_once __DIR__ . '/config/db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];

// Get monthly expense by category
$report = $pool->execute(
    "SELECT category, SUM(amount) AS total
     FROM transactions
     WHERE user_id = ?
     AND type = 'expense'
     AND YEAR(created_at) = YEAR(CURRENT_DATE)
     AND MONTH(created_at) = MONTH(CURRENT_DATE)
     GROUP BY category
     ORDER BY total DESC",
    [$userId]
);

// Get total monthly expense
$totalResult = $pool->execute(
    "SELECT COALESCE(SUM(amount), 0) AS total
     FROM transactions
     WHERE user_id = ?
     AND type = 'expense'
     AND YEAR(created_at) = YEAR(CURRENT_DATE)
     AND MONTH(created_at) = MONTH(CURRENT_DATE)",
    [$userId]
);

$totalRow = $totalResult->fetchRow();
$totalExpense = $totalRow["total"] ?? 0;

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>Monthly Report - Expense Tracker</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<h1>Student Expense Tracker</h1>

<h2>Monthly Expense Summary</h2>

<table border="1" cellpadding="10">

    <tr>

        <th>Category</th>

        <th>Total Expense</th>

    </tr>

    <?php foreach ($report as $row): ?>

    <tr>

        <td>
            <?php echo htmlspecialchars($row["category"]); ?>
        </td>

        <td>
            ₹<?php echo number_format($row["total"], 2); ?>
        </td>

    </tr>

    <?php endforeach; ?>

</table>

<br>

<h3>
    Total Expense:
    ₹<?php echo number_format($totalExpense, 2); ?>
</h3>

<br>

<a href="dashboard.php">
    Back to Dashboard
</a>

</body>

</html>