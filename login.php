<?php

session_start();

require_once __DIR__ . '/config/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = $pool->execute(
        "SELECT * FROM users WHERE email = ?",
        [$email]
    );

    $user = $result->fetchRow();

    if ($user && $user["password"] === $password) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];

        header("Location: dashboard.php");
        exit;

    } else {

        $message = "Invalid email or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | SpendWise</title>

    <link rel="stylesheet"
          href="css/style.css?v=10">

</head>

<body class="login-page">

<div class="login-wrapper">

    <!-- LEFT SIDE -->

    <div class="login-showcase">

        <div class="brand">

            <div class="brand-icon">
                ₹
            </div>

            <span>SpendWise</span>

        </div>


        <div class="showcase-content">

            <p class="eyebrow">
                STUDENT FINANCE MANAGER
            </p>

            <h1>
                Take control of
                <span>your money.</span>
            </h1>

            <p class="showcase-text">
                Track your income, manage expenses and
                understand your spending habits — all in
                one simple place.
            </p>


            <div class="feature-list">

                <div class="feature-item">

                    <div class="feature-icon">
                        ₹
                    </div>

                    <div>
                        <strong>
                            Track every transaction
                        </strong>

                        <p>
                            Keep your income and expenses organized.
                        </p>
                    </div>

                </div>


                <div class="feature-item">

                    <div class="feature-icon">
                        ✓
                    </div>

                    <div>
                        <strong>
                            Stay within your budget
                        </strong>

                        <p>
                            Know where your money goes every month.
                        </p>
                    </div>

                </div>


                <div class="feature-item">

                    <div class="feature-icon">
                        ↗
                    </div>

                    <div>
                        <strong>
                            View monthly insights
                        </strong>

                        <p>
                            Understand your spending by category.
                        </p>
                    </div>

                </div>

            </div>

        </div>


        <div class="showcase-footer">
            Simple. Smart. Student-friendly.
        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="login-panel">

        <div class="login-card">

            <div class="mobile-brand">

                <div class="brand-icon">
                    ₹
                </div>

                <span>SpendWise</span>

            </div>


            <div class="login-heading">

                <p class="small-heading">
                    WELCOME BACK
                </p>

                <h2>
                    Sign in to your account
                </h2>

                <p>
                    Manage your finances with ease.
                </p>

            </div>


            <?php if ($message): ?>

                <div class="error-message">
                    <?php echo htmlspecialchars($message); ?>
                </div>

            <?php endif; ?>


            <form method="post"
                  class="login-form">

                <div class="input-group">

                    <label for="email">
                        Email address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="you@example.com"
                        required
                    >

                </div>


                <div class="input-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="login-button">

                    Sign In
                    <span>→</span>

                </button>

            </form>


            <div class="register-text">

                Don't have an account?

                <a href="register.php">
                    Create one
                </a>

            </div>


            <div class="secure-note">

                🔒 Your financial data stays private.

            </div>

        </div>

    </div>

</div>

</body>

</html>