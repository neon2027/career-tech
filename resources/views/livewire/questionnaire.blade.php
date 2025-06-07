<div>
    
   <div class="sticky top-0 z-10">
     <div class="p-12 bg-gradient-to-r from-[#0C00CF] to-[#C00A29] sticky top-0 z-10 shadow-lg">
        <h1 class="text-2xl text-center text-white font-bold">DreamTech Career Quiz</h1>
        <p class="text-center text-white mt-2">Find the best tech career for your personality in just 10 minutes!</p>
    </div>
    <div class=" bg-gradient-to-r from-[#E7E5FF] to-[#FEE7EB] p-1 h-full">
        <div id="progress-bar" class="rounded-lg bg-[#463DE4] h-5 w-0 text-end font-bold transition-all duration-300 ease-in-out" wire:ignore.self>
            <p class="pr-2"></p>
        </div>
    </div>
    
   </div>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="space-y-16">
            @forelse($personalityQuestions as $index => $q)
                <div id="question-{{ $index }}" class="transition-all duration-300">
                    <h1 class="text-center text-sm md:text-lg font-bold">{{ $q->question }}</h1>
                    <div class="flex justify-center mt-4 gap-4 md:gap-8 items-center">
                        <p class="font-semibold text-gray-500">Disagree</p>
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="grid items-center justify-center">
                                <label>
                                    <input 
                                        type="radio" 
                                        class="hidden peer" 
                                        name="question-{{ $q->id }}"
                                        wire:model.live="answers.{{ $q->id }}" 
                                        value="{{ $i }}"
                                        onclick="scrollToNext({{ $index }})"
                                    >
                                    <div class="peer-checked:bg-[#463DE4] rounded-full peer-checked:block hidden">
                                        <svg class="w-10 h-10 p-1 rounded-full border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-600 peer-checked:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" color='white' />
                                        </svg>
                                    </div>

                                    <div class="peer-checked:bg-[#463DE4] rounded-full block peer-checked:hidden">
                                        <svg class="w-10 h-10 p-1 rounded-full border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-600 peer-checked:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        </svg>
                                    </div>


                                </label>
                            </div>
                        @endfor
                        <p class="font-semibold text-gray-500">Agree</p>
                    </div>
                </div>
            @empty
                <div class="text-gray-500">No questions available.</div>
            @endforelse
            <div class="flex flex-col items-center mt-8">
                @error('answers')
                    <div class="text-red-500 mb-4">{{ $message }}</div>
                @enderror
                <button 
                    wire:click="submitAnswers" 
                    class="
                    bg-gradient-to-r from-[#0C00CF] to-[#C00A29]
                     text-white px-4 py-2 rounded hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed"
                    @if($this->answeredCount < count($personalityQuestions)) disabled @endif
                >
                    Submit Answers ({{ $this->answeredCount }}/{{ count($personalityQuestions) }})
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

    @if(!$showSubmissionModal)
        <livewire:quiz-submission :answers="$answers" :highest-types="$highestTypes" />
    @endif
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
