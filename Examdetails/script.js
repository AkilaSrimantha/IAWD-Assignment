// Search Functionality
document.getElementById("searchButton").addEventListener("click", function() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const examInfo = document.querySelectorAll(".exam-info");

    examInfo.forEach(exam => {
        const examTitle = exam.querySelector("button.collapsible").textContent.toLowerCase();
        if (examTitle.includes(input)) {
            exam.style.display = "block";
        } else {
            exam.style.display = "none";
        }
    });
});

// Collapsible functionality
const collapsibles = document.querySelectorAll(".collapsible");

collapsibles.forEach(button => {
    button.addEventListener("click", function() {
        this.classList.toggle("active");
        const content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
});

// Countdown Timer
function countdownTimer(examDate) {
    const examTime = new Date(examDate).getTime();
    const timerElement = document.getElementById("timer");

    const timerInterval = setInterval(function() {
        const now = new Date().getTime();
        const timeLeft = examTime - now;

        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        timerElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;

        if (timeLeft < 0) {
            clearInterval(timerInterval);
            timerElement.innerHTML = "EXAM TIME!";
        }
    }, 1000);
}

// Set timer for nearest exam
countdownTimer("Oct 23, 2024 10:00:00");

// Alert Button for Reminder
document.getElementById("alertButton").addEventListener("click", function() {
    alert("Don't forget to prepare for your exams!");
});
