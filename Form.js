// จับเหตุการณ์การส่งฟอร์ม
document.getElementById('backPainForm').addEventListener('submit', function(event){
    event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

    // สร้างตัวแปรเพื่อเก็บคะแนนรวมและคำตอบ
    let totalScore = 0;
    let answers = [];

    // วนลูปเพื่อดึงค่าคะแนนจากคำถามทั้ง 10 ข้อ
    for(let i = 1; i <= 10; i++) {
        let selectedOption = document.querySelector(`input[name="q${i}"]:checked`);
        if(selectedOption) {
            let questionScore = parseInt(selectedOption.value);
            totalScore += questionScore;
            answers.push({
                question: i,
                score: questionScore
            });
        } else {
            alert(`กรุณาตอบคำถามข้อที่ ${i}`);
            return;
        }
    }

    // เก็บคะแนนรวมและคำตอบใน localStorage
    localStorage.setItem('totalScore', totalScore);
    localStorage.setItem('answers', JSON.stringify(answers));

    // นำผู้ใช้ไปยังหน้าผลลัพธ์
    window.location.href = 'Result.html';
});
