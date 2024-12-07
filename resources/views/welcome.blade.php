@extends('layouts.main')
@section('content')
    <div x-data="{ signin: false }"
        class="bg-gray-900 min-h-screen h-full text-white pb-[250px] font-sans bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
        <section class="bg-white dark:bg-gray-900/70 px-6 py-8 pt-16 mx-auto">
            {{-- <div class="z-10 relative grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12"> --}}
            <div
                class="hidden lg:mt-0 lg:col-span-5 lg:flex px-4 py-8 mx-auto h-[300px] w-[300px] absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <x-lottie path="https://assets7.lottiefiles.com/packages/lf20_4oq2x2.json" />
                <x-lottie class="" path="{{ asset('asset/animation/welcome.json') }}" />
            </div>
            <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 z-10 relative translate-y-1/2">
                <h1
                    class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    Inventory Management Tool</h1>
                <p class="mb-8 text-sm font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">
                    From stock tracking to real-time inventory analysis, web applications that simplify inventory
                    management and optimize operations.</p>
                <form action="{{ route('login') }}" method="POST" class="w-full max-w-md mx-auto">
                    @csrf
                    <div>
                        <label for="default-email"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Email
                            sign-in</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-x-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                            </div>
                            <input type="email" id="default-email" name="email"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter your email here..." required />
                            <button type="button" x-show="!signin" @click="signin = !signin"
                                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
                                in</button>
                        </div>
                    </div>
                    <div class="mt-4" x-show="signin">
                        <label for="default-email"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Password
                            sign-in</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-x-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor">
                                    <title>lock</title>
                                    <path
                                        d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                                </svg>
                            </div>
                            <input type="password" id="default-email" name="password"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter your password here..." required />
                            <button type="submit"
                                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
                                in</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-4 mx-auto space-y-4 text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36 lg:translate-y-[160%]">
                {{-- <span class="font-semibold text-gray-400 uppercase">AVAILABLE FOR</span> --}}
                {{-- <div class="grid grid-cols-1 justify-items-start mx-auto lg:grid-cols-3 gap-4 text-gray-400 ">
                    <div class="flex items-center mt-4">
                        <x-mdi-toolbox class="w-14" />
                        <p class="ml-2 text-sm font-medium lg:text-lg">OFFICE TOOLS</p>
                    </div>
                    <div class="flex items-center mt-4">
                        <x-mdi-broom class="w-14 " />
                        <p class="ml-2 text-sm text-sm font-medium lg:text-lg">CLEANING TOOLS</p>
                    </div>
                    <div class="flex items-center mt-4">
                        <x-mdi-toothbrush-paste class="w-14" />
                        <p class="ml-2 text-sm text-sm font-medium lg:text-lg">AND MORE</p>
                    </div>
                </div> --}}
            </div>
            <div
                class="bg-gradient-to-b from-blue-50/20 to-transparent dark:from-blue-900/40 w-full h-full absolute top-0 left-0 z-0">
            </div>
        </section>
    </div>
@endsection
