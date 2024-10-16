<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
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
            max-width: 500px;
            margin-top: 50px;
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
        .form-group label {
            font-weight: bold;
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
        <h1><i class="fas fa-user-md"></i> สร้างบัญชีของคุณ</h1>
        <form action="process-register.php" method="POST">
            <div class="form-group">
                <label for="username_account">ชื่อผู้ใช้</label>
                <input name="username_account" type="text" class="form-control" placeholder="ชื่อผู้ใช้" required>
            </div>
            <div class="form-group">
                <label for="email_account">อีเมล</label>
                <input name="email_account" type="email" class="form-control" placeholder="อีเมล" required>
            </div>
            <div class="form-group">
                <label for="password_account1">รหัสผ่านใหม่</label>
                <input name="password_account1" type="password" class="form-control" placeholder="รหัสผ่านใหม่" required>
            </div>
            <div class="form-group">
                <label for="password_account2">ยืนยันรหัสผ่าน</label>
                <input name="password_account2" type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
            </div>
            <button type="submit" class="btn btn-primary">สร้างบัญชี</button>
            <div class="text-center">
                <a href="form-login.php">มีบัญชีแล้วใช่ไหม</a>
            </div>
        </form>
    </div>

    <!-- เชื่อมต่อกับ jQuery และ Bootstrap JS (ถ้าจำเป็นสำหรับฟังก์ชันการทำงานของ Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
