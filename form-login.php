<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ</title>
    <!-- เชื่อมต่อกับ Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- เชื่อมต่อกับ FontAwesome สำหรับไอคอน -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <style>
        body {
            background-color: #f0f8ff; /* พื้นหลังสีฟ้าอ่อนสำหรับธีมหมอ */
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin-top: 80px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 30px;
            text-align: center;
            color: #007bff; /* สีฟ้าสำหรับธีมหมอ */
        }
        .btn-primary {
            width: 100%;
        }
        .text-center a {
            display: block;
            margin-top: 15px;
            color: #007bff;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fas fa-user-md"></i> เข้าสู่ระบบ</h1>
        <form action="process-login.php" method="POST">
            <div class="form-group">
                <label for="email_account">อีเมล</label>
                <input name="email_account" type="email" class="form-control" placeholder="อีเมล" required>
            </div>
            <div class="form-group">
                <label for="password_account">รหัสผ่าน</label>
                <input name="password_account" type="password" class="form-control" placeholder="รหัสผ่าน" required>
            </div>
            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
            <div class="text-center">
                <a href="form-register.php">สร้างบัญชีใหม่</a>
            </div>
        </form>
    </div>

    <!-- เชื่อมต่อกับ jQuery และ Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
