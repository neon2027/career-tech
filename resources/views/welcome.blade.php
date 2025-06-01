<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="text-xs md:text-sm">
    

    <main>
        @livewire('questionnaire')
    </main>
    
    @vite('resources/js/app.js')
    <script>
        function scrollToNext(currentId) {
        // Delay to allow Livewire DOM updates
        setTimeout(() => {
            const current = document.getElementById(`question-${currentId}`);
            if (!current) return;

            const allQuestions = document.querySelectorAll('[id^="question-"]');
            for (let i = 0; i < allQuestions.length; i++) {
                if (allQuestions[i].id === `question-${currentId}` && i + 1 < allQuestions.length) {
                    const next = allQuestions[i + 1];

                    // Center the next element in the viewport
                    const elementTop = next.getBoundingClientRect().top + window.scrollY;
                    const elementHeight = next.offsetHeight;
                    const offset = elementTop - (window.innerHeight / 2) + (elementHeight / 2);

                    window.scrollTo({
                        top: offset,
                        behavior: 'smooth'
                    });

                    break;
                }
            }
        }, 150); // small delay for DOM update
    }
        </script>
</body>
</html>