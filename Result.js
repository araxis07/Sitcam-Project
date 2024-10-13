// รับคะแนนรวมและคำตอบจาก localStorage
let totalScore = localStorage.getItem('totalScore');
let answers = JSON.parse(localStorage.getItem('answers'));

// ตรวจสอบว่ามีข้อมูลหรือไม่
if(totalScore && answers) {
    // แปลความหมายของคะแนน
    let interpretation = '';
    if(totalScore <= 10) {
        interpretation = 'อาการปวดหลังของท่านอยู่ในระดับน้อย';
    } else if(totalScore <= 20) {
        interpretation = 'อาการปวดหลังของท่านอยู่ในระดับปานกลาง';
    } else if(totalScore <= 30) {
        interpretation = 'อาการปวดหลังของท่านอยู่ในระดับมาก';
    } else if(totalScore <= 40) {
        interpretation = 'อาการปวดหลังของท่านอยู่ในระดับรุนแรง';
    } else {
        interpretation = 'อาการปวดหลังของท่านอยู่ในระดับรุนแรงมาก';
    }

    // สร้างเนื้อหาสำหรับแสดงผล
    let content = `
        <h2>คะแนนรวมของท่าน: ${totalScore} คะแนน</h2>
        <p>${interpretation}</p>
        <h3>รายละเอียดคำตอบ:</h3>
        <ul>
    `;

    answers.forEach(answer => {
        content += `<li>คำถามที่ ${answer.question}: คะแนน ${answer.score}</li>`;
    });

    content += '</ul>';

    // แสดงเนื้อหาในหน้าเว็บ
    document.getElementById('resultContent').innerHTML = content;
} else {
    // หากไม่มีข้อมูล ให้แจ้งเตือนและนำกลับไปยังหน้าแบบฟอร์ม
    alert('ไม่พบข้อมูลผลลัพธ์');
    window.location.href = 'Form.html'; 
}