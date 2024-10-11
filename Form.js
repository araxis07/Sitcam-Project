// จับเหตุการณ์การส่งฟอร์ม
document.getElementById('backPainForm').addEventListener('submit', function(event){
    event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

    // สร้างตัวแปรเพื่อเก็บคะแนนรวม
    let totalScore = 0;

    // วนลูปเพื่อดึงค่าคะแนนจากคำถามทั้ง 10 ข้อ
    for(let i = 1; i <= 10; i++) {
        let questionScore = parseInt(document.querySelector(`input[name="q${i}"]:checked`).value);
        totalScore += questionScore;
    }

    // แสดงผลคะแนนรวม (คุณสามารถปรับปรุงส่วนนี้ตามความต้องการ)
    alert(`คะแนนรวมของคุณคือ ${totalScore} คะแนน`);

    // ตัวอย่าง: นำผู้ใช้ไปยังหน้าผลลัพธ์
    // window.location.href = 'result.html'; ถ้าต้องการ link html ต่อไปหรือทําอย่างอื่นเชื่อมฐานข้อมูล เช่น PHP เป็นต้น หน้า ให้ลบ // ข้างหน้าออก เพื่อใช้ window.location.href = 'result.html'; 
    // หรือ ลบไปทั้งหมดก็ได้ถ้าจะใช้อย่างอื่นแทนเขียนไว้ก่อนคิดไม่ออก
});
