<?php 
include 'config.php';
session_start();

function prepareAndExecute($conn, $sql, $params)
{
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('mysqli error: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    $stmt->execute();
    return $stmt;
}

if (isset($_POST['Emp_login_submit'])) {
    $email = $_POST['Emp_Email'];
    $password = $_POST['Emp_Password'];
    $sql = "SELECT * FROM emp_login WHERE Emp_Email = ? AND Emp_Password = BINARY ?";
    $stmt = prepareAndExecute($conn, $sql, [$email, $password]);
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['usermail'] = $email;
        header("Location: admin/admin.php");
        exit();
    } else {
        echo "<script>swal({ title: 'Invalid credentials', icon: 'error', });</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login - Hotel Blue Bird</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Internal CSS -->
    <style>
        /* Background Animation */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(-45deg, #0d47a1, #1976d2, #64b5f6, #82b1ff);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            overflow: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Section Styling */
        #staff_login_section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Glowing Card */
        .login_container {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 191, 255, 0.4), 0 0 60px rgba(0, 191, 255, 0.2);
            width: 340px;
            padding: 30px;
            text-align: center;
            color: #fff;
            animation: slideIn 1.2s ease, pulseGlow 4s infinite alternate;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseGlow {
            0% {
                box-shadow: 0 0 20px rgba(0, 191, 255, 0.4), 0 0 60px rgba(0, 191, 255, 0.2);
            }
            100% {
                box-shadow: 0 0 40px rgba(0, 191, 255, 0.7), 0 0 80px rgba(0, 191, 255, 0.4);
            }
        }

        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            color: #e3f2fd;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            margin-top: 5px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.8);
            outline: none;
        }

        .login_button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #29b6f6, #0288d1);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 191, 255, 0.5);
            transition: all 0.3s ease;
        }

        .login_button:hover {
            background: linear-gradient(to right, #0288d1, #01579b);
            box-shadow: 0 6px 25px rgba(0, 191, 255, 0.7);
            transform: scale(1.05);
        }

        form {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>

<section id="staff_login_section">
    <div class="login_container">
        <h2>Staff Login</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="Emp_Email">Email</label>
                <input type="email" name="Emp_Email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="Emp_Password">Password</label>
                <input type="password" name="Emp_Password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="Emp_login_submit" class="login_button">Log In</button>
        </form>
    </div>
</section>

</body>
</html>
