<div>
  <div class="sticky top-0 z-20 bg-gradient-to-r from-[#0C00CF] to-[#C00A29] p-12">
    <h1 class="text-center text-white">Your DreamTech Personality is</h1>
    @if ($isTie)
      <p class="text-center font-bold text-white mt-2 text-3xl md:text-4xl">
        Tie Result: {{ $personalityTypes->pluck('name')->join(' & ') }}
      </p>
      <p class="text-center text-white mt-2 text-lg">
        You have equal strengths in multiple personality types!
      </p>
    @else
      <p class="text-center font-bold text-white mt-2 text-3xl md:text-4xl">
        {{ $personalityTypes->first()->name }} ({{ $personalityTypes->first()->title }})
      </p>
    @endif
  </div>

  <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8 px-4">
    @if ($isTie)
      {{-- Tabbed Interface for Tie Results --}}
      <div x-data="{ activeTab: '{{ $personalityTypes->first()->id }}' }" class="w-full">
        {{-- Tab Navigation --}}
        <div class="flex border-b border-gray-200 mb-8">
          @foreach ($personalityTypes as $type)
            <button @click="activeTab = '{{ $type->id }}'"
              :class="activeTab === '{{ $type->id }}' ? 'border-blue-500 text-blue-600 bg-blue-50' :
                  'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-lg transition-colors duration-200">
              <div class="flex items-center justify-center space-x-3">
                <span class="text-3xl">
                  @if ($type->name === 'Realistic')
                    💪
                  @elseif($type->name === 'Investigative')
                    🧠
                  @elseif($type->name === 'Artistic')
                    🎨
                  @elseif($type->name === 'Social')
                    💬
                  @elseif($type->name === 'Enterprising')
                    🚀
                  @elseif($type->name === 'Conventional')
                    📋
                  @endif
                </span>
                <div class="text-center">
                  <div class="font-bold">{{ $type->name }}</div>
                  <div class="text-sm opacity-75">({{ $type->title }})</div>
                </div>
              </div>
            </button>
          @endforeach
        </div>

        {{-- Tab Content --}}
        @foreach ($personalityTypes as $type)
          <div x-show="activeTab === '{{ $type->id }}'" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            {{-- Personality Description --}}
            <div class="p-4 bg-[#F7F3F3] rounded-lg space-y-4 mb-8">
              <p class="text-sm font-semibold">
                {{ $type->description }}
              </p>
              <p
                class="text-sm italic font-semibold text-transparent bg-gradient-to-r from-[#0C00CF] to-[#C00A29] bg-clip-text">
                "{{ $type->summary }}"
              </p>
            </div>

            {{-- Tech Career Path --}}
            <div>
              <h2 class="text-2xl font-bold my-16 text-center">
                Your Tech Career Path
              </h2>
              <div class="grid grid-cols-1 gap-4">
                @foreach ($type->careers as $career)
                  <div class="border rounded-lg p-4 border-gray-300 hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold">{{ $career->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $career->description }}</p>
                  </div>
                @endforeach
              </div>

              {{-- Next Steps --}}
              @if ($type->next_steps)
                <div class="mt-8">
                  <h1 class="text-2xl font-bold mb-8 text-center">What to Do Next?</h1>
                  <div class="rounded-lg">
                    <p class="text-sm text-gray-700">{{ $type->next_steps }}</p>
                  </div>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      {{-- Single Personality Type Result --}}
      <div class="p-4 bg-[#F7F3F3] rounded-lg space-y-4">
        <p class="text-sm font-semibold">
          {{ $personalityTypes->first()->description }}
        </p>
        <p
          class="text-sm italic font-semibold text-transparent bg-gradient-to-r from-[#0C00CF] to-[#C00A29] bg-clip-text">
          "{{ $personalityTypes->first()->summary }}"
        </p>
      </div>

      <div>
        <h2 class="text-2xl font-bold my-16 text-center">
          Your Tech Career Path
        </h2>
        <div class="grid grid-cols-1 gap-4">
          @foreach ($personalityTypes->first()->careers as $career)
            <div class="border rounded-lg p-4 border-gray-300 hover:shadow-md transition-shadow">
              <h3 class="text-lg font-semibold ">{{ $career->name }}</h3>
              <p class="text-sm text-gray-600">{{ $career->description }}</p>
            </div>
          @endforeach
        </div>

        {{-- Next Steps --}}
        @if ($personalityTypes->first()->next_steps)
          <div class="mt-8">
            <h1 class="text-2xl font-bold mb-8 text-center">What to Do Next?</h1>
            <div class="rounded-lg">
              <p class="text-sm text-gray-700">{{ $personalityTypes->first()->next_steps }}</p>
            </div>
          </div>
        @endif
      </div>
    @endif
  </div>
</div>
