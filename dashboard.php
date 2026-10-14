<?php

session_start();

require_once __DIR__ . '/config/db.php';

// =========================
// CHECK LOGIN
// =========================

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$userName = $_SESSION["user_name"] ?? "Student";


// =========================
// DELETE TRANSACTION
// =========================

if (isset($_GET["delete"])) {

    $transactionId = (int) $_GET["delete"];

    if ($transactionId > 0) {

        $pool->execute(
            "DELETE FROM transactions
             WHERE id = ? AND user_id = ?",
            [
                $transactionId,
                $userId
            ]
        );
    }

    // Remove ?delete= from URL
    header("Location: dashboard.php");
    exit;
}


// =========================
// TOTAL INCOME
// =========================

$incomeResult = $pool->execute(
    "SELECT COALESCE(SUM(amount), 0) AS total
     FROM transactions
     WHERE user_id = ? AND type = 'income'",
    [$userId]
);

$incomeRow = $incomeResult->fetchRow();

$totalIncome = $incomeRow["total"] ?? 0;


// =========================
// TOTAL EXPENSE
// =========================

$expenseResult = $pool->execute(
    "SELECT COALESCE(SUM(amount), 0) AS total
     FROM transactions
     WHERE user_id = ? AND type = 'expense'",
    [$userId]
);

$expenseRow = $expenseResult->fetchRow();

$totalExpense = $expenseRow["total"] ?? 0;


// =========================
// BALANCE
// =========================

$balance = $totalIncome - $totalExpense;


// =========================
// GET TRANSACTIONS
// =========================

$transactions = $pool->execute(
    "SELECT id, type, category, amount, description, created_at
     FROM transactions
     WHERE user_id = ?
     ORDER BY id DESC",
    [$userId]
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Student Expense Tracker</title>

    <link rel="stylesheet" href="css/style.css?v=5">

</head>

<body>

    <!-- HEADER -->

    <div class="page-header">

        <div>

            <h1>Student Expense Tracker</h1>

            <p class="welcome">
                Welcome, <?php echo htmlspecialchars($userName); ?>!
            </p>

        </div>

        <a href="logout.php" class="logout-btn">
            Logout
        </a>

    </div>


    <hr>


    <!-- FINANCIAL SUMMARY -->

    <h2>Financial Summary</h2>

    <div class="summary-container">

        <div class="summary-card income-card">

            <p class="card-title">
                Total Income
            </p>

            <h2>
                ₹<?php echo number_format((float)$totalIncome, 2); ?>
            </h2>

        </div>


        <div class="summary-card expense-card">

            <p class="card-title">
                Total Expenses
            </p>

            <h2>
                ₹<?php echo number_format((float)$totalExpense, 2); ?>
            </h2>

        </div>


        <div class="summary-card balance-card">

            <p class="card-title">
                Balance
            </p>

            <h2>
                ₹<?php echo number_format((float)$balance, 2); ?>
            </h2>

        </div>

    </div>


    <hr>


    <!-- TRANSACTIONS -->

    <div class="section-header">

        <h2>Transactions</h2>

        <a href="add_transaction.php" class="add-btn">
            + Add Transaction
        </a>

    </div>


    <!-- SEARCH + FILTER -->

    <div class="filter-container">

        <input
            type="text"
            id="search"
            placeholder="Search transaction..."
        >

        <select id="category">

            <option value="all">All Categories</option>

            <option value="Food">Food</option>

            <option value="Travel">Travel</option>

            <option value="Books">Books</option>

            <option value="Hostel">Hostel</option>

            <option value="Entertainment">Entertainment</option>

            <option value="Education">Education</option>

            <option value="Other">Other</option>

        </select>

    </div>


    <!-- TRANSACTION TABLE -->

    <div class="table-container">

        <table id="transactionTable">

            <thead>

                <tr>

                    <th>Type</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                <?php foreach ($transactions as $transaction): ?>

                    <tr>

                        <td>

                            <span class="transaction-type <?php

                                echo ($transaction["type"] === "income")
                                    ? "income-type"
                                    : "expense-type";

                            ?>">

                                <?php

                                echo htmlspecialchars(
                                    ucfirst($transaction["type"])
                                );

                                ?>

                            </span>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $transaction["category"]
                            );

                            ?>

                        </td>


                        <td>

                            <strong>

                                ₹<?php

                                echo number_format(
                                    (float)$transaction["amount"],
                                    2
                                );

                                ?>

                            </strong>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $transaction["description"] ?? ""
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $transaction["created_at"]
                            );

                            ?>

                        </td>


                        <td class="action-links">

                            <!-- EDIT -->

                            <a
                                href="edit_transaction.php?id=<?php echo (int)$transaction["id"]; ?>"
                            >
                                Edit
                            </a>

                            <span>|</span>


                            <!-- DELETE -->

                            <a
                                href="dashboard.php?delete=<?php echo (int)$transaction["id"]; ?>"
                                onclick="return confirm('Are you sure you want to delete this transaction?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>


    <!-- MONTHLY REPORT -->

    <div class="bottom-links">

        <a href="report.php" class="report-btn">
            View Monthly Report
        </a>

    </div>


    <script src="js/dashboard.js?v=2"></script>

</body>

</html>