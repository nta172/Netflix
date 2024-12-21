<?php
session_start();

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_netflix";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công, lưu session và chuyển hướng đến trang chính
        $_SESSION["username"] = $username;
        header("Location: trang3.php");
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng";
    }
}

$conn->close();
?>

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="header">
        <nav>
            <a href="trang1.php"><img src="logo.png"  class="logo" alt=""></a>
            <div>
                <button class="language-btn">English <img src="image/down-icon.png" alt=""></button>
                <button>Sign In</button>
            </div>
        </nav>
        <div class="login-box">
            <h2>Log In</h2>

 <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
            <form action="">
                <div class="input-box">
                    <input type="email" placeholder="Email or phone number">
                </div>
    
                <div class="input-box">
                    <input type="text" placeholder="Password">
                </div>
            </form>
            <button type="submit">Đăng Nhập</button>
    
            <div class="support">
                <div class="remember">
                    <span><input type="checkbox"></span>
                    <p>Remember me</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>