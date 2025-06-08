<div>

  <div class="sticky top-0 z-10">
    <div class="p-12 bg-gradient-to-r from-[#0C00CF] to-[#C00A29] sticky top-0 z-10 shadow-lg">
      <h1 class="text-4xl text-center text-white font-bold">DreamTech Career Quiz</h1>
      <p class="text-center text-white mt-2">Find the best tech career for your personality in just 10 minutes!</p>
    </div>
    <div class=" bg-gradient-to-r from-[#E7E5FF] to-[#FEE7EB] p-1 h-full">
      <div id="progress-bar"
        class="rounded-lg bg-[#463DE4] h-5 w-0 text-end font-bold transition-all duration-300 ease-in-out"
        wire:ignore.self>
        <p class="pr-2"></p>
      </div>
    </div>

  </div>
  <div class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="space-y-24 md:space-y-18">
      @if (session('message'))
        <div class="flex justify-center">
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded max-w-md text-center">
            {{ session('message') }}
          </div>
        </div>
      @endif

      @if (app()->isLocal())
        <div class="flex justify-center gap-4 mb-4">
          @if ($this->answeredCount > 0)
            <button wire:click="clearSession"
              class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors"
              onclick="confirm('Are you sure you want to clear all your answers?') || event.stopImmediatePropagation()">
              Clear All Answers
            </button>
          @endif

          <!-- Testing Button - Always visible -->
          <button wire:click="fillRandomAnswers"
            class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600 transition-colors font-semibold border-2 border-yellow-700"
            title="For testing purposes only - fills all questions with random answers">
            🎲 Fill Random (Testing)
          </button>
        </div>
      @endif

      @forelse($personalityQuestions as $index => $q)
        <div id="question-{{ $index }}" class="transition-all duration-300">
          <h1 class="text-center text-lg md:text-lg font-bold">{{ $q->question }}</h1>
          <div class="flex justify-center mt-4 gap-2 md:gap-8 items-center">
            <p class="font-semibold text-gray-500 text-sm md:text-base">Disagree</p>
            @for ($i = 1; $i <= 5; $i++)
              <div class="grid items-center justify-center">
                <label>
                  <input type="radio" class="hidden peer" name="question-{{ $q->id }}"
                    wire:model.live="answers.{{ $q->id }}" value="{{ $i }}"
                    onclick="scrollToNext({{ $index }})">
                  <div class="peer-checked:bg-[#463DE4] rounded-full peer-checked:block hidden">
                    <svg
                      class="w-10 h-10 p-1 rounded-full border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-600 peer-checked:text-white"
                      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" color='white' />
                    </svg>
                  </div>

                  <div class="peer-checked:bg-[#463DE4] rounded-full block peer-checked:hidden">
                    <svg
                      class="w-10 h-10 p-1 rounded-full border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-600 peer-checked:text-white"
                      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor">
                    </svg>
                  </div>

                </label>
              </div>
            @endfor
            <p class="font-semibold text-gray-500 text-sm md:text-base">Agree</p>
          </div>
        </div>
      @empty
        <div class="text-gray-500">No questions available.</div>
      @endforelse
      <div class="flex flex-col items-center mt-8">
        @error('answers')
          <div class="text-red-500 mb-4">{{ $message }}</div>
        @enderror
        <button wire:click="submitAnswers"
          class="
                    bg-gradient-to-r from-[#0C00CF] to-[#C00A29]
                     text-white px-4 py-2 rounded hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed"
          @if ($this->answeredCount < count($personalityQuestions)) disabled @endif>
          Submit Answers ({{ $this->answeredCount }}/{{ count($personalityQuestions) }})
        </button>
      </div>

    </div>
  </div>

  @if ($showSubmissionModal)
    <livewire:quiz-submission :answers="$answers" :highest-types="$highestTypes" />
  @endif
</div>

@script
  <script>
    // Initialize progress bar on page load
    document.addEventListener('DOMContentLoaded', function() {
      const answeredCount = {{ $this->answeredCount }};
      const totalQuestions = {{ count($personalityQuestions ?? []) }};
      updateProgressBar(answeredCount, totalQuestions);
    });

    function updateProgressBar(answered, total) {
      const progressBar = document.getElementById('progress-bar');
      const percent = total > 0 ? (answered / total) * 100 : 0;
      progressBar.style.width = percent + '%';
      progressBar.innerHTML = `<p class="pr-2">${answered} / ${total}</p>`;
    }

    // Function to disable/enable body scrolling
    function toggleBodyScroll(disable) {
      if (disable) {
        document.body.style.overflow = 'hidden';
        document.body.style.paddingRight = '15px'; // Prevent layout shift from scrollbar
      } else {
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
      }
    }

    // Watch for progress updates
    $wire.on('update-progress', event => {
      const {
        answered,
        total
      } = event[0];
      console.log('Updating progress bar:', answered, total);
      updateProgressBar(answered, total);
    });

    // Handle modal state changes
    $wire.on('modal-opened', () => {
      toggleBodyScroll(true);
    });

    $wire.on('modal-closed', () => {
      toggleBodyScroll(false);
    });

    // Use Livewire hook to detect DOM changes and check modal state
    Livewire.hook('morph.updated', ({
      el,
      component
    }) => {
      // Check if modal is present in DOM
      const modalExists = document.querySelector('[x-show="show"]');
      const showModal = {{ $showSubmissionModal ? 'true' : 'false' }};

      if (showModal && modalExists) {
        toggleBodyScroll(true);
      } else if (!showModal) {
        toggleBodyScroll(false);
      }
    });

    // Cleanup when leaving page
    window.addEventListener('beforeunload', () => {
      toggleBodyScroll(false);
    });

    // Handle page visibility changes (when user switches tabs)
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        toggleBodyScroll(false);
      }
    });
  </script>
@endscript
