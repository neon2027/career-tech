import './bootstrap';

// Initialize the first question as focused
document.addEventListener('DOMContentLoaded', () => {
    // Set all questions to reduced opacity first
    document.querySelectorAll('[id^="question-"]').forEach(question => {
        question.classList.add('opacity-50');
        question.classList.remove('opacity-100');
    });

    // Then set the first question to full opacity
    const firstQuestion = document.querySelector('[id^="question-"]');
    if (firstQuestion) {
        firstQuestion.classList.remove('opacity-50');
        firstQuestion.classList.add('opacity-100');
    }
});

window.scrollToNext = function(currentIndex) {
    // Delay to allow Livewire DOM updates
    setTimeout(() => {
        // Get all questions
        const allQuestions = document.querySelectorAll('[id^="question-"]');
        
        // If there's a next question
        if (currentIndex + 1 < allQuestions.length) {
            // Set all questions to reduced opacity
            allQuestions.forEach(question => {
                question.classList.add('opacity-50');
                question.classList.remove('opacity-100');
            });

            // Set next question to full opacity
            const nextQuestion = allQuestions[currentIndex + 1];
            nextQuestion.classList.remove('opacity-50');
            nextQuestion.classList.add('opacity-100');

            // Center the next element in the viewport
            const elementTop = nextQuestion.getBoundingClientRect().top + window.scrollY;
            const elementHeight = nextQuestion.offsetHeight;
            const offset = elementTop - (window.innerHeight / 2) + (elementHeight / 2);

            window.scrollTo({
                top: offset,
                behavior: 'smooth'
            });

            // Update Livewire component's currentQuestionIndex
            window.Livewire.dispatch('question-answered', [currentIndex + 1]);
        }
    }, 150); // small delay for DOM update
}