<form method="POST" action="{{ route('profile.destroy') }}">
  @csrf
  @method('delete')

  <div>
    <label for="password" class="block text-sm font-medium text-black">Confirm with Password</label>
    <input
      id="password"
      name="password"
      type="password"
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500"
      placeholder="Your current password"
      required
    />
    @error('password', 'userDeletion')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
  </div>

  <div class="mt-6">
    <button
      type="submit"
      onclick="return confirm('Are you sure? This will permanently delete your account.')"
      class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition"
    >
      Delete Account
    </button>
  </div>
</form>
