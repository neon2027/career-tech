import './bootstrap';

window.scrollToNext = function(currentIndex) {
    // Delay to allow Livewire DOM updates
    setTimeout(() => {
        // Get all questions
        const allQuestions = document.querySelectorAll('[id^="question-"]');
        
        // If there's a next question
        if (currentIndex + 1 < allQuestions.length) {

            // Set next question to full opacity
            const nextQuestion = allQuestions[currentIndex + 1];

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