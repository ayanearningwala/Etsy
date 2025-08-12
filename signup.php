<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Etsy Clone</title>
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }
    header {
      background-color: #f1641e;
      color: #fff;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      margin: 0;
    }
    header nav a {
      color: #fff;
      text-decoration: none;
      margin-left: 20px;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    /* Signup Page Styles */
    .signup-container {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
      margin: 50px auto;
    }
    .signup-container h2 {
      margin-bottom: 20px;
    }
    .signup-container input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .signup-container button {
      width: 100%;
      padding: 10px;
      background-color: #f1641e;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .signup-container button:hover {
      background-color: #d4531a;
    }
    .signup-container a {
      color: #f1641e;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <header>
    <h1>Etsy Clone</h1>
    <nav>
      <a href="login.php">Login</a>
      <a href="signup.php">Sign Up</a>
    </nav>
  </header>

  <div class="container">
    <!-- Signup Form -->
    <div class="signup-container">
      <h2>Sign Up</h2>
      <form action="signup.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="signup">Sign Up</button>
      </form>
      <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
  </div>

  <?php
  // Handle Signup
  if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple validation
    if (!empty($name) && !empty($email) && !empty($password)) {
      // Here you can add database logic to store the user
      echo "<script>alert('Signup successful!');</script>";
    } else {
      echo "<script>alert('Please fill in all fields.');</script>";
    }
  }
  ?>
</body>
</html>
