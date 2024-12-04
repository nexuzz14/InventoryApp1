<x-app-layout>
    <div x-data=" { show: false }" class="w-full h-full flex flex-col items-center justify-start">
        {{-- <div class="buttonbox flex w-full justify-end p-4">
            <button @click="show =! show"
                class="group whitespace-nowrap w-40 overflow-hidden shadow-md bg-gradient-to-r from-emerald-400 to-cyan-400 text-white flex justify-between items-center rounded">
                <p class=" group-hover:w-0 w-full duration-200">Tambah Petugas</p>
                <div
                    class="icon w-10 h-8 text-gray-400 bg-white group-hover:text-white group-hover:bg-green-400 flex group-hover:w-full duration-200 items-center justify-center">
                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </div>
            </button>
        </div> --}}
        {{-- @livewire('listPetugas') --}}
        {{-- <div x-show="show"
            class="absolute w-full z-20 h-full top-0 left-0 bg-black bg-opacity-50 flex items-center justify-center">
            <x-form-layout :action="route('petugasregister')">
                @csrf
                <div class="text-3xl mb-8 w-full text-center font-bold">
                    Petugas Baru
                </div>
                <div>
                    <x-text-input :id="'username'" class="block mt-1 w-full" :title="__('Username')" :name="'username'"
                        :value="old('username')" required autofocus :autocomplete="'username'" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>
                <div>
                    <x-password-input :id="'password'" :title="__('Password')" :name="'password'" :value="old('password')" required
                        autofocus :autocomplete="'new-password'" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-password-input :id="'password_confirmation'" :title="__('Confirm Password')" :name="'password_confirmation'" :value="old('password_confirmation')"
                        required autofocus :autocomplete="'new-password'" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                <div class="flex items-center justify-end mt-4">
                    <button @click="show = !show"
                        class="bg-green-500 rounded-lg border border-white px-3 p-[8px] box-border text-white font-medium">Kembali</button>
                    <x-primary-button class="ms-2">
                        {{ __('Tambah') }}
                    </x-primary-button>
                </div>
            </x-form-layout>
        </div> --}}
    </div>
    {{-- @if (SESSION('message'))
    <x-notiv :message="SESSION('message')"></x-notiv>
        
    @endif --}}
</x-app-layout>
