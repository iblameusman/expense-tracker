@extends('layouts.app')

@section('header')
  <h2 class="text-3xl font-extrabold text-black">
    Profile
  </h2>
@endsection

@section('content')
  <div class="min-h-screen bg-white">
    <div class="max-w-3xl mx-auto space-y-8 py-8">

      {{-- Update Profile Information --}}
      <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
        <h3 class="text-xl font-semibold text-black mb-2">Profile Information</h3>
        <p class="text-sm text-black mb-6">
          Update your account’s profile information and email address.
        </p>
        @include('profile.partials.update-profile-information-form')
      </div>

      {{-- Delete Account --}}
      <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
        <h3 class="text-xl font-semibold text-black mb-2">Delete Account</h3>
        <p class="text-sm text-black mb-6">
          Once your account is deleted, all of its resources and data will be permanently deleted.
          Before deleting your account, please download any data or information that you wish to retain.
        </p>
        @include('profile.partials.delete-user-form')
      </div>

    </div>
  </div>
@endsection
