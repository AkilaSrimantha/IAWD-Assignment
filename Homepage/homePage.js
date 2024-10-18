var feedbackImages = [
    "img/feedback1.jpg",
    "img/feedback2.jpg",
    "img/feedback3.jpg"
];
var currentImageIndex = 0;

function nextFeedback() {
    currentImageIndex = (currentImageIndex + 1) % feedbackImages.length;
    document.getElementById("feedback-image").src = feedbackImages[currentImageIndex];
}

function prevFeedback() {
    currentImageIndex = (currentImageIndex - 1 + feedbackImages.length) % feedbackImages.length;
    document.getElementById("feedback-image").src = feedbackImages[currentImageIndex];
}
