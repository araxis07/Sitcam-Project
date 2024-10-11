// จับเหตุการณ์การส่งฟอร์ม
document.getElementById('loginForm').addEventListener('submit', function(event){
    event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

    // รับค่าจากฟิลด์อินพุต
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // ตรวจสอบว่าผู้ใช้ได้กรอกข้อมูลหรือไม่
    if(username && password){
        // เปลี่ยนหน้าไปยัง Form.html
        window.location.href = 'Form.html';
    } else {
        alert('กรุณากรอกชื่อผู้ใช้และรหัสผ่าน');
    }
});
