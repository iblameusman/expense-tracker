<form method="POST" action="{{ route('profile.update') }}">
  @csrf
  @method('patch')

  <!-- Name -->
  <div>
    <label for="name" class="block text-sm font-medium text-black">Name</label>
    <input
      id="name"
      name="name"
      type="text"
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-500 focus:ring-sky-500"
      value="{{ old('name', $user->name) }}"
      required
      autofocus
    />
    @error('name')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>

  <!-- Email -->
  <div class="mt-4">
    <label for="email" class="block text-sm font-medium text-black">Email</label>
    <input
      id="email"
      name="email"
      type="email"
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-sky-500 focus:ring-sky-500"
      value="{{ old('email', $user->email) }}"
      required
    />
    @error('email')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>

  <!-- Save Button -->
  <div class="mt-6">
    <button
      type="submit"
      class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white font-medium rounded-lg transition"
    >
      Save
    </button>
  </div>
</form>
