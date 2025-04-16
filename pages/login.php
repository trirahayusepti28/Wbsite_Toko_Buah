<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Simulasi username dan password untuk admin, customer, dan staf
    $credentials = [
        'admin' => [
            'username' => 'admin',
            'password' => 'admin123'
        ],
        'customer' => [
            'username' => 'customer',
            'password' => 'customer123'
        ],
        'staf' => [
            'username' => 'staf',
            'password' => 'staf123'
        ]
    ];

    // Validasi login
    if (isset($credentials[$role]) && 
        $username === $credentials[$role]['username'] && 
        $password === $credentials[$role]['password']) {
        
        // Login berhasil
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        if ($role == 'admin') {
            header("Location: admin/form.php");
        } elseif ($role == 'customer') {
            header("Location: customer/dashboard.php");
        } elseif ($role == 'staf') {
            header("Location: staf/manage.php");
        }
        exit();
    } else {
        // Login gagal
        $error_message = "Username, password, atau role salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://bdsgp.my.id/img/1200/bsob0d3ebsogk72t2x_2/hPE73GaJt3mJfgYhPEunqToujSr3N1S1eHW1uzNjWJZA.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: linear-gradient(to bottom, #ffffff, #ffe6e6);
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #555;
        }
        .login-container input,
        .login-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container button {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            transition: background 0.3s;
        }
        .login-container button:hover {
            background: linear-gradient(to right, #feb47b, #ff7e5f);
        }
        .login-container p {
            margin-top: 15px;
            color: #555;
        }
        .login-container p a {
            color: #ff6600;
            text-decoration: none;
        }
        .login-container p a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
        .home-link {
            margin-top: 20px;
            display: block;
            text-align: center;
        }
        .home-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .home-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?= htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
                <option value="staf">Staf</option>
            </select>
            <button type="submit">Login</button>
        </form>
        <div class="home-link">
            <a href="../index.php">Kembali ke Home</a>
        </div>
    </div>
</body>
</html>