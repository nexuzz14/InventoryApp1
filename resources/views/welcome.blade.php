@extends('layouts.main')
@section('content')
    <div
        class="relative flex min-h-screen text-gray-800 antialiased flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div class="relative py-3 sm:w-96 mx-auto text-center">
            <span class="text-2xl font-light ">Login to your account</span>
            <form action="{{ route('login') }}" method="POST" class="mt-4 bg-white shadow-md rounded-lg text-left">
                @csrf
                <div class="h-2 bg-blue-400 rounded-t-md"></div>
                <div class="px-8 py-6 ">
                    <label class="block font-semibold"> Username</label>
                    <input type="text" placeholder="Username" name="username"
                        class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:shadow-lg focus:ring-1 rounded-md">
                    <label class="block mt-3 font-semibold"> Password </label>
                    <input type="password" name="password" placeholder="Password"
                        class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:shadow-lg focus:ring-1 rounded-md">
                    @error('email')
                        <p class="text-xs mt-2 text-red-500">Email Atau Password Salah</p>
                    @enderror
                    <div class="flex justify-between items-baseline">
                        <button type="submit"
                            class="mt-4 bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 ">Login</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
