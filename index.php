<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>SpendWise | Student Expense Tracker</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f6f3eb;
            color: #20352c;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            height: 78px;
            padding: 0 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border-bottom: 1px solid #e8e4da;
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
            background: #234b3b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links a {
            text-decoration: none;
            color: #315c48;
            font-size: 14px;
            font-weight: bold;
        }

        .get-started {
            background: #234b3b;
            color: white !important;
            padding: 11px 19px;
            border-radius: 9px;
        }

        .get-started:hover {
            background: #183a2d;
        }


        /* =========================
           HERO
        ========================= */

        .hero {
            min-height: 570px;
            padding: 70px 8%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-content {
            max-width: 580px;
        }

        .label {
            color: #527c66;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .hero h1 {
            margin: 0;
            font-size: 70px;
            line-height: 1.02;
            letter-spacing: -3px;
            color: #18352a;
        }

        .hero h1 span {
            color: #527c66;
        }

        .hero-description {
            margin-top: 25px;
            color: #718077;
            font-size: 17px;
            line-height: 1.8;
            max-width: 520px;
        }


        /* =========================
           HERO BUTTONS
        ========================= */

        .buttons {
            margin-top: 30px;
            display: flex;
            gap: 12px;
        }

        .primary-button,
        .secondary-button {
            padding: 14px 22px;
            border-radius: 11px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .primary-button {
            background: #234b3b;
            color: white;
        }

        .primary-button:hover {
            background: #183a2d;
        }

        .secondary-button {
            background: white;
            color: #315c48;
            border: 1px solid #dcded8;
        }

        .secondary-button:hover {
            background: #eef3ee;
        }


        /* =========================
           DASHBOARD PREVIEW
        ========================= */

        .visual {
            min-height: 430px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-card {
            width: 390px;
            background: white;
            padding: 28px;
            border-radius: 22px;
            border: 1px solid #e7e4dc;
            box-shadow: 0 25px 60px rgba(32, 53, 44, 0.14);
            position: relative;
            z-index: 2;
        }

        .balance-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .balance-label {
            color: #8b938e;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .balance {
            margin-top: 7px;
            font-size: 31px;
            font-weight: bold;
            color: #20352c;
        }

        .balance-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #e7f0e8;
            color: #315c48;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .line {
            height: 1px;
            background: #eeeae1;
            margin: 25px 0;
        }

        .transaction {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .transaction-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #eef3ee;
            color: #527c66;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .transaction-info {
            flex: 1;
        }

        .transaction-info strong {
            display: block;
            color: #34483e;
            font-size: 13px;
        }

        .transaction-info small {
            color: #9ba19d;
            font-size: 10px;
        }

        .expense {
            color: #a65347;
            font-weight: bold;
            font-size: 13px;
        }

        .income {
            color: #397052;
            font-weight: bold;
            font-size: 13px;
        }


        /* =========================
           FLOATING CARDS
        ========================= */

        .floating-card {
            position: absolute;
            background: white;
            border: 1px solid #e6e3db;
            box-shadow: 0 15px 35px rgba(32, 53, 44, 0.12);
            border-radius: 15px;
            padding: 14px 17px;
            display: flex;
            align-items: center;
            gap: 11px;
            z-index: 3;
        }

        .top-card {
            top: 25px;
            left: 0;
        }

        .bottom-card {
            bottom: 25px;
            right: 0;
        }

        .floating-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #e8f0e9;
            color: #397052;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .floating-card small {
            display: block;
            color: #8b938e;
            font-size: 10px;
        }

        .floating-card strong {
            display: block;
            margin-top: 4px;
            color: #20352c;
            font-size: 15px;
        }


        /* =========================
           FEATURES
        ========================= */

        .features {
            padding: 10px 8% 60px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feature {
            background: white;
            border: 1px solid #e5e2d9;
            border-radius: 17px;
            padding: 25px;
        }

        .feature-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: #e8f0e9;
            color: #315c48;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .feature h3 {
            margin: 16px 0 8px;
            font-size: 17px;
            color: #20352c;
        }

        .feature p {
            margin: 0;
            color: #7b867f;
            font-size: 13px;
            line-height: 1.6;
        }


        /* =========================
           FOOTER
        ========================= */

        footer {
            text-align: center;
            padding: 25px;
            color: #9aa19c;
            font-size: 11px;
        }


        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 850px) {

            .navbar {
                padding: 0 20px;
            }

            .hero {
                grid-template-columns: 1fr;
                padding: 50px 25px;
                gap: 30px;
            }

            .hero h1 {
                font-size: 50px;
            }

            .visual {
                min-height: 380px;
            }

            .dashboard-card {
                width: 90%;
            }

            .top-card {
                left: 0;
            }

            .bottom-card {
                right: 0;
            }

            .features {
                grid-template-columns: 1fr;
                padding: 20px 25px 40px;
            }
        }

    </style>

</head>


<body>


    <!-- =========================
         NAVIGATION
    ========================= -->

    <nav class="navbar">

        <div class="brand">

            <div class="logo">
                ₹
            </div>

            <span>
                SpendWise
            </span>

        </div>


        <div class="nav-links">

            <a href="login.php">
                Login
            </a>

            <a href="register.php"
               class="get-started">

                Get Started

            </a>

        </div>

    </nav>



    <!-- =========================
         HERO SECTION
    ========================= -->

    <section class="hero">


        <div class="hero-content">

            <div class="label">
                STUDENT FINANCE MANAGER
            </div>


            <h1>

                Your money.
                <br>

                <span>
                    Your control.
                </span>

            </h1>


            <p class="hero-description">

                A simple and smart way for students
                to track income, manage expenses and
                understand where their money goes.

            </p>


            <div class="buttons">

                <a href="register.php"
                   class="primary-button">

                    Get Started →
                    
                </a>


                <a href="login.php"
                   class="secondary-button">

                    Sign In

                </a>

            </div>

        </div>



        <!-- =========================
             DASHBOARD PREVIEW
        ========================= -->

        <div class="visual">


            <div class="floating-card top-card">

                <div class="floating-icon">
                    ↗
                </div>

                <div>

                    <small>
                        Total Income
                    </small>

                    <strong>
                        ₹20,000
                    </strong>

                </div>

            </div>



            <div class="dashboard-card">


                <div class="balance-header">

                    <div>

                        <div class="balance-label">
                            AVAILABLE BALANCE
                        </div>

                        <div class="balance">
                            ₹6,500
                        </div>

                    </div>


                    <div class="balance-icon">
                        ₹
                    </div>

                </div>


                <div class="line"></div>



                <div class="transaction">

                    <div class="transaction-icon">
                        F
                    </div>

                    <div class="transaction-info">

                        <strong>
                            Food
                        </strong>

                        <small>
                            Today
                        </small>

                    </div>

                    <span class="expense">
                        -₹350
                    </span>

                </div>



                <div class="transaction">

                    <div class="transaction-icon">
                        T
                    </div>

                    <div class="transaction-info">

                        <strong>
                            Travel
                        </strong>

                        <small>
                            Yesterday
                        </small>

                    </div>

                    <span class="expense">
                        -₹500
                    </span>

                </div>



                <div class="transaction">

                    <div class="transaction-icon">
                        I
                    </div>

                    <div class="transaction-info">

                        <strong>
                            Income
                        </strong>

                        <small>
                            Oct 05
                        </small>

                    </div>

                    <span class="income">
                        +₹2,000
                    </span>

                </div>


            </div>



            <div class="floating-card bottom-card">

                <div class="floating-icon">
                    ✓
                </div>

                <div>

                    <small>
                        Monthly Expenses
                    </small>

                    <strong>
                        ₹2,100
                    </strong>

                </div>

            </div>


        </div>

    </section>



    <!-- =========================
         FEATURES
    ========================= -->

    <section class="features">


        <div class="feature">

            <div class="feature-icon">
                ₹
            </div>

            <h3>
                Track Expenses
            </h3>

            <p>
                Record every expense and income
                in one organized place.
            </p>

        </div>



        <div class="feature">

            <div class="feature-icon">
                ✓
            </div>

            <h3>
                Stay Organized
            </h3>

            <p>
                Search and filter your transactions
                whenever you need.
            </p>

        </div>



        <div class="feature">

            <div class="feature-icon">
                ↗
            </div>

            <h3>
                Monthly Insights
            </h3>

            <p>
                Understand how much you spend
                in each category.
            </p>

        </div>


    </section>



    <!-- =========================
         FOOTER
    ========================= -->

    <footer>

        SpendWise · Student Expense Tracker

    </footer>


</body>

</html>