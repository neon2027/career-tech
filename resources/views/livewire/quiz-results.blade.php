<div>
  <div class="sticky top-0 bg-gradient-to-r from-[#0C00CF] to-[#C00A29] p-12">
    <h1 class=" text-center text-white ">Your DreamTech Personality is</h1>
    <p class="text-center font-bold text-white mt-2 text-3xl md:text-4xl">
      {{ $result->personalityType->name }} ({{ $result->personalityType->title }})
    </p>
  </div>
  <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8 px-4">
    <div class="p-4 bg-[#F7F3F3] rounded-lg space-y-4">
      <p class="text-sm font-semibold">
        {{ $result->personalityType->description }}
      </p>
      <p class="text-sm italic font-semibold text-transparent bg-gradient-to-r from-[#0C00CF] to-[#C00A29] bg-clip-text">
        "{{ $result->personalityType->summary }}"
      </p>
    </div>

    <div>
      <h2 class="text-2xl font-bold my-16 text-center">
        Your Tech Career Path
      </h2>
      <div class="grid grid-cols-1 gap-4">
        @foreach ($result->personalityType->careers as $career)
          <div class="border rounded-lg p-4 border-gray-300">
            <h3 class="text-lg font-semibold">{{ $career->name }}</h3>
            <p class="text-sm text-gray-600">{{ $career->description }}</p>
          </div>
        @endforeach
      </div>
      <div class="mt-8">
        <h1 class="text-2xl font-bold mb-8 text-center">What to Do Next?</h1>
        <p class="text-sm text-gray-700">{{ $result->personalityType->next_steps }}</p>
      </div>
    </div>
  </div>
</div>
