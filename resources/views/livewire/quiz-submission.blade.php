<div>
  <!-- Modal Backdrop -->
  <div x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak class="fixed inset-0 z-40 bg-gray-800 opacity-50 transition-opacity"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
  </div>

  <!-- Modal Panel -->
  <div x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
      <div
        class="relative transform overflow-hidden rounded-lg bg-white py-[44px] px-[36px] text-left shadow-xl transition-all sm:w-full sm:max-w-lg">

        <div class="space-y-2 mb-6">
          <h1 class="text-2xl font-bold">
            Your results are ready!
          </h1>
          @if ($highestTypes->count() > 1)
            <p class="text-gray-500">You have a tie between {{ $highestTypes->pluck('name')->join(' & ') }}! Enter your
              details to see both results.</p>
          @else
            <p class="text-gray-500">Enter your name and email to see your career matches.</p>
          @endif
        </div>

        <form wire:submit.prevent="submit" class="space-y-4">
          <div>
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
              <input type="text" wire:model="name" id="name"
                class="mt-1 block w-full rounded-[10px] border-gray-300 p-2 border focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="mb-4">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" wire:model="email" id="email"
                class="mt-1 p-2 block w-full rounded-[10px] border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="mt-5 grid grid-cols-1">
            <button type="submit"
              class="bg-gradient-to-r from-[#0C00CF] to-[#C00A29] text-white px-4 py-2 rounded-[10px] hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed">
              Get My Results
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
