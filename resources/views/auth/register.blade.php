<x-guest-layout>
    @include('layouts.navigation')

    <x-form-layout :action="route('register')">
        @csrf
        <div class="text-3xl mb-8 w-full text-center font-bold">
            Register
        </div>
        <div>
            <x-text-input :id="'username'" class="block mt-1 w-full" :title="__('Username')" :name="'username'" :value="old('username')" required autofocus :autocomplete="'username'" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>
        <div>
            <x-text-input :id="'name'" class="block mt-1 w-full" :title="__('Name')" :name="'name'" :value="old('name')" required autofocus :autocomplete="'name'" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-text-input :id="'email'" class="block mt-1 w-full" :title="__('Email')" :name="'email'" :value="old('email')" required autofocus :autocomplete="'email'" :type="'email'" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-text-input :id="'Nik'" class="block mt-1 w-full" :title="__('NIK')" :name="'nik'" :value="old('nik')" required autofocus :autocomplete="''" :type="'text'" />
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div>
        <div>
            <x-text-input :id="'telp'" class="block mt-1 w-full" :title="__('No Telp')" :name="'telp'" :value="old('telp')" required autofocus :autocomplete="''" :type="'text'" />
            <x-input-error :messages="$errors->get('telp')" class="mt-2"/>
        </div>
        <div>
            <x-input-area-text :value="old('alamat')" :name="'alamat'" :title="'Alamat'"></x-input-area-text>
            <x-input-error :messages="$errors->get('telp')" class="mt-2"/>
        </div>
        <div>
            <x-input-label class="mt-3">Jenis Kelamin</x-input-label>
            <div class="flex gap-2 items-center mt-2">
                <div class="flex items-center gap-1 p-2 px-4 bg-white rounded-full">
                  <input type="radio" name="jk" id="Laki-laki" value="L" class="accent-blue-500">
                  <label for="Laki-laki" class="text-gray-700">Laki-laki</label>
                </div>
                <div class="flex items-center gap-1 p-2 px-4 bg-white rounded-full">
                  <input type="radio" name="jk" id="Perempuan" value="P" class="accent-pink-500">
                  <label for="Perempuan" class="text-gray-700">Perempuan</label>
                </div>
              </div>
              
        </div>
        <div>
            <x-password-input :id="'password'" :title="__('Password')" :name="'password'" :value="old('password')" required autofocus :autocomplete="'new-password'" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        
        <div>
            <x-password-input :id="'password_confirmation'" :title="__('Confirm Password')" :name="'password_confirmation'" :value="old('password_confirmation')" required autofocus :autocomplete="'new-password'" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
       

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </x-form-layout>
</x-guest-layout>
