<?php

session_start();

require_once __DIR__ . '/config/db.php';

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    try {

        $pool->execute(
            "INSERT INTO users (name, email, password)
             VALUES (?, ?, ?)",
            [$name, $email, $password]
        );

        $message = "Account created successfully!";
        $success = true;

    } catch (Throwable $e) {

        $message = "Email already exists. Please use another email.";

    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Create Account | SpendWise</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f6f3eb;
            color: #20352c;
        }

        .register-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }


        /* LEFT SIDE */

        .register-showcase {
            background:
                radial-gradient(
                    circle at 80% 20%,
                    rgba(116,151,130,0.22),
                    transparent 35%
                ),
                linear-gradient(
                    145deg,
                    #18352a,
                    #234b3b
                );

            color: white;
            padding: 55px 9%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 21px;
            font-weight: bold;
        }

        .logo {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #dce8d9;
            color: #234b3b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .showcase-content {
            max-width: 500px;
        }

        .eyebrow {
            color: #b9d0bf;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .showcase-content h1 {
            font-size: 58px;
            line-height: 1.05;
            letter-spacing: -2px;
            margin: 15px 0;
        }

        .showcase-content h1 span {
            color: #c8dbc7;
        }

        .showcase-content > p {
            color: #c5d2cb;
            font-size: 16px;
            line-height: 1.8;
        }

        .benefits {
            margin-top: 35px;
            display: flex;
            flex-direction: column;
            gap: 17px;
        }

        .benefit {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d8e6d8;
            font-size: 14px;
        }

        .check {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: rgba(255,255,255,0.10);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-text {
            color: #91a89c;
            font-size: 11px;
        }


        /* RIGHT SIDE */

        .register-panel {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .register-card {
            width: 100%;
            max-width: 430px;
        }

        .mobile-brand {
            display: none;
        }

        .heading {
            margin-bottom: 28px;
        }

        .heading small {
            color: #527c66;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .heading h2 {
            margin: 10px 0 8px;
            font-size: 31px;
            letter-spacing: -1px;
            color: #20352c;
        }

        .heading p {
            margin: 0;
            color: #7b867f;
            font-size: 14px;
        }


        /* MESSAGE */

        .message {
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .success {
            background: #e8f3ea;
            color: #397052;
            border: 1px solid #cfe4d2;
        }

        .error {
            background: #f8e8e5;
            color: #a34e43;
            border: 1px solid #efd1cc;
        }


        /* FORM */

        .register-form {
            background: transparent;
            padding: 0;
            margin: 0;
            width: 100%;
            max-width: none;
            border: none;
            box-shadow: none;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #34483e;
            font-size: 13px;
        }

        .input-group input {
            width: 100%;
            height: 52px;
            padding: 0 16px;
            margin: 0;
            border: 1px solid #dddcd4;
            border-radius: 12px;
            background: white;
            color: #26332d;
            font-size: 14px;
        }

        .input-group input:focus {
            outline: none;
            border-color: #527c66;
            box-shadow: 0 0 0 4px rgba(82,124,102,0.10);
        }


        /* BUTTON */

        .create-button {
            width: 100%;
            height: 52px;
            margin-top: 8px;
            border: none;
            border-radius: 12px;
            background: #234b3b;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .create-button:hover {
            background: #183a2d;
        }


        /* LOGIN LINK */

        .login-text {
            text-align: center;
            margin-top: 23px;
            color: #7c847f;
            font-size: 13px;
        }

        .login-text a {
            color: #315c48;
            font-weight: bold;
            text-decoration: none;
        }

        .secure {
            text-align: center;
            color: #9a9f9b;
            font-size: 11px;
            margin-top: 28px;
        }


        /* MOBILE */

        @media (max-width: 850px) {

            .register-page {
                grid-template-columns: 1fr;
            }

            .register-showcase {
                display: none;
            }

            .register-panel {
                min-height: 100vh;
                padding: 25px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 45px;
                color: #234b3b;
                font-weight: bold;
            }

            .mobile-brand .logo {
                width: 38px;
                height: 38px;
                background: #234b3b;
                color: white;
            }

            .heading h2 {
                font-size: 27px;
            }
        }

    </style>

</head>


<body>


<div class="register-page">


    <!-- LEFT -->

    <section class="register-showcase">


        <div class="brand">

            <div class="logo">
                ₹
            </div>

            <span>
                SpendWise
            </span>

        </div>


        <div class="showcase-content">

            <div class="eyebrow">
                START YOUR FINANCE JOURNEY
            </div>

            <h1>
                Build better
                <span>money habits.</span>
            </h1>

            <p>
                Create your free account and start
                managing your student finances
                in a simple and organized way.
            </p>


            <div class="benefits">

                <div class="benefit">

                    <div class="check">
                        ✓
                    </div>

                    Track income and expenses

                </div>


                <div class="benefit">

                    <div class="check">
                        ✓
                    </div>

                    Organize spending by category

                </div>


                <div class="benefit">

                    <div class="check">
                        ✓
                    </div>

                    View your monthly spending

                </div>

            </div>

        </div>


        <div class="footer-text">
            Simple. Smart. Student-friendly.
        </div>

    </section>



    <!-- RIGHT -->

    <section class="register-panel">


        <div class="register-card">


            <div class="mobile-brand">

                <div class="logo">
                    ₹
                </div>

                <span>
                    SpendWise
                </span>

            </div>


            <div class="heading">

                <small>
                    GET STARTED
                </small>

                <h2>
                    Create your account
                </h2>

                <p>
                    Start managing your money today.
                </p>

            </div>


            <?php if ($message): ?>

                <div class="message <?php echo $success ? 'success' : 'error'; ?>">

                    <?php echo htmlspecialchars($message); ?>

                </div>

            <?php endif; ?>


            <?php if (!$success): ?>

            <form method="post"
                  class="register-form">


                <div class="input-group">

                    <label>
                        Full name
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter your name"
                        required
                    >

                </div>


                <div class="input-group">

                    <label>
                        Email address
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="you@example.com"
                        required
                    >

                </div>


                <div class="input-group">

                    <label>
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Create a password"
                        minlength="4"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="create-button">

                    Create Account

                </button>


            </form>

            <?php endif; ?>


            <div class="login-text">

                Already have an account?

                <a href="login.php">
                    Sign in
                </a>

            </div>


            <div class="secure">
                🔒 Your information is kept private.
            </div>


        </div>

    </section>

</div>


</body>

</html>