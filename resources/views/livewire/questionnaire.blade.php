<div>
    <div class="sticky top-0 z-30 bg-gray-300 h-5">
        <div id="progress-bar" class="bg-blue-500 h-5 w-0 text-end font-bold transition-all duration-300 ease-in-out" wire:ignore.self>
            <p class="pr-2"></p>
        </div>
    </div>
    
    <div class="p-12 bg-gray-700 sticky top-0 z-10 shadow-lg">
        <h1 class="text-2xl text-center text-white font-bold">Career Tech Questionnaire</h1>
        <p class="text-center text-white mt-2">Please answer the following questions to help us understand your personality better.</p>

    </div>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="space-y-16">
            @forelse($personalityQuestions as $q)
                <div id="question-{{ $q->id }}">
                    <h1 class="text-center text-sm md:text-lg font-bold">{{ $q->question }}</h1>
                    <div class="flex justify-center mt-4 gap-4 md:gap-8 items-center">
                        <p class="font-bold">Disagree</p>
                        @for ($index = 1; $index <= 5; $index++)
                            <div class="grid items-center justify-center">
                                <div>
                                    <input 
                                        type="radio" 
                                        class="size-8" 
                                        name="question-{{ $q->id }}"
                                        wire:model.live="answers.{{ $q->id }}" 
                                        value="{{ $index }}"
                                        onclick="scrollToNext({{ $q->id }})"
                                    >
                                </div>
                                <label class="text-sm text-center">{{ $index }}</label>
                            </div>
                        @endfor
                        <p class="font-bold">Agree</p>
                    </div>
                </div>
            @empty
                <div class="text-gray-500">No questions available.</div>
            @endforelse
            <div class="flex justify-center mt-8">
                <button wire:click="submitAnswers" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Submit Answers
                </button>
            </div>
            @if($highestTypes)
                <div class="mt-8 max-w-3xl mx-auto bg-white p-6 rounded shadow-lg">
                    <h2 class="text-center text-xl font-bold">Your Personality Types</h2>
                    <div>
                        @foreach($highestTypes as $type)
                            <div class="bg-gray-200 p-4 rounded mt-2">
                                <h3 class="text-lg font-semibold">{{ $type->name }}</h3>
                                <p>{{ $type->description }}</p>
                                <blockquote class="mt-2 italic text-gray-600">
                                    "{{ $type->summary }}"
                                </blockquote>

                                <div>
                                    <h1 class="text-lg font-bold">Here are some IT careers that fit you well:</h1>
                                    <ul class="list-disc pl-5 mt-2">
                                        @foreach($type->careers as $career)
                                            <li><b>{{ $career->name }}</b> - {{ $career->description }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@script

<script>
        $wire.on('update-progress', event => {
            const { answered, total } = event[0];
            const progressBar = document.getElementById('progress-bar');

            console.log('Updating progress bar:', answered, total);

            const percent = total > 0 ? (answered / total) * 100 : 0;
            progressBar.style.width = percent + '%';
            progressBar.innerHTML = `<p>${answered} / ${total}</p>`;
        });

        
</script>

@endscript