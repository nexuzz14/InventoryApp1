@extends('layouts.dashboard')
@section('content')
    <div class="grid grid-cols-4 gap-6 xl:grid-cols-1">
        <x-card-item :label="'Category'" :value="$category" :color="'teal'"><x-mdi-vector-arrange-below /></x-card-item>
        <x-card-item :label="'Supplier'" :value="$suppliers" :color="'red'"><x-mdi-truck-fast /></x-card-item>
        <x-card-item :label="'Barang'" :value="$items" :color="'red'"><x-mdi-cube-outline/></x-card-item>
        <x-card-item :label="'Orders'" :value="'50'" :color="'red'"><x-mdi-cart-plus /></x-card-item>
    </div>
    <!-- End General Report -->

    <!-- strat Analytics -->
    <div class="mt-6 grid grid-cols-2 gap-6 xl:grid-cols-1">

        <!-- update section -->
        <div class="card ">
            <x-listcard />
        </div>
        <!-- end update section -->

        <!-- carts -->
        <div class="flex flex-col">
            <div class="mb-6">
                {!! $chart->container() !!}
            </div>

            <div class="alert alert-dark mb-6">
                Historycal Data
            </div>

            <div class="h-[200px]">
                <div class="card py-2">
                    {{-- <div class="py-3 px-4 flex flex-row justify-between absolute">
                        <div
                            class="bg-teal-200 text-teal-700 border-teal-300 border w-10 h-10 rounded-full flex justify-center items-center">
                            <i class="fad fa-eye"></i>
                        </div>
                    </div> --}}
                    {!! $historyRequestChart->container() !!}
                </div>

            </div>
            <!-- charts    -->

        </div>


    </div>
    <!-- end Analytics -->

    <!-- Sales Overview -->
    {{-- <div class="card mt-6">

        <!-- header -->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Sales Overview</h1>

            <div class="flex flex-row justify-center items-center">

                <a href="">
                    <i class="fad fa-chevron-double-down mr-6"></i>
                </a>

                <a href="">
                    <i class="fad fa-ellipsis-v"></i>
                </a>

            </div>

        </div>
        <!-- end header -->

        <!-- body -->
        <div class="card-body grid grid-cols-2 gap-6 lg:grid-cols-1">

            <div class="p-8">
                <h1 class="h2">5,337</h1>
                <p class="text-black font-medium">Sales this month</p>

                <div class="mt-20 mb-2 flex items-center">
                    <div class="py-1 px-3 rounded bg-green-200 text-green-900 mr-3">
                        <i class="fa fa-caret-up"></i>
                    </div>
                    <p class="text-black"><span class="num-2 text-green-400"></span><span class="text-green-400">% more
                            sales</span> in comparison to last month.</p>
                </div>

                <div class="flex items-center">
                    <div class="py-1 px-3 rounded bg-red-200 text-red-900 mr-3">
                        <i class="fa fa-caret-down"></i>
                    </div>
                    <p class="text-black"><span class="num-2 text-red-400"></span><span class="text-red-400">% revenue per
                            sale</span> in comparison to last month.</p>
                </div>

                <a href="#" class="btn-shadow mt-6">view details</a>

            </div>

            <div class="">
                <div id="sealsOverview">
                    1
                </div>
            </div>

        </div>
        <!-- end body -->

    </div>
    <!-- end Sales Overview -->

    <!-- start numbers -->
    <div class="grid grid-cols-5 gap-6 xl:grid-cols-2">

        <!-- card -->
        <div class="card mt-6">
            <div class="card-body flex items-center">

                <div class="px-3 py-2 rounded bg-indigo-600 text-white mr-3">
                    <i class="fad fa-wallet"></i>
                </div>

                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2"></span> Sales</h1>
                    <p class="text-xs"><span class="num-2"></span> payments</p>
                </div>

            </div>
        </div>
        <!-- end card -->

        <!-- card -->
        <div class="card mt-6">
            <div class="card-body flex items-center">

                <div class="px-3 py-2 rounded bg-green-600 text-white mr-3">
                    <i class="fad fa-shopping-cart"></i>
                </div>

                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2"></span> Orders</h1>
                    <p class="text-xs"><span class="num-2"></span> items</p>
                </div>

            </div>
        </div>
        <!-- end card -->

        <!-- card -->
        <div class="card mt-6 xl:mt-1">
            <div class="card-body flex items-center">

                <div class="px-3 py-2 rounded bg-yellow-600 text-white mr-3">
                    <i class="fad fa-blog"></i>
                </div>

                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2"></span> posts</h1>
                    <p class="text-xs"><span class="num-2"></span> active</p>
                </div>

            </div>
        </div>
        <!-- end card -->

        <!-- card -->
        <div class="card mt-6 xl:mt-1">
            <div class="card-body flex items-center">

                <div class="px-3 py-2 rounded bg-red-600 text-white mr-3">
                    <i class="fad fa-comments"></i>
                </div>

                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2"></span> comments</h1>
                    <p class="text-xs"><span class="num-2"></span> approved</p>
                </div>

            </div>
        </div>
        <!-- end card -->

        <!-- card -->
        <div class="card mt-6 xl:mt-1 xl:col-span-2">
            <div class="card-body flex items-center">

                <div class="px-3 py-2 rounded bg-pink-600 text-white mr-3">
                    <i class="fad fa-user"></i>
                </div>

                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2"></span> memebrs</h1>
                    <p class="text-xs"><span class="num-2"></span> online</p>
                </div>

            </div>
        </div>
        <!-- end card -->

    </div>
    <!-- end nmbers -->

    <!-- start quick Info -->
    <div class="grid grid-cols-3 gap-6 mt-6 xl:grid-cols-1">


        <!-- Browser Stats -->
        <div class="card">
            <div class="card-header">Browser Stats</div>

            <!-- brawser -->
            <div class="p-6 flex flex-row justify-between items-center text-gray-600 border-b">
                <div class="flex items-center">
                    <i class="fab fa-chrome mr-4"></i>
                    <h1>google chrome</h1>
                </div>
                <div>
                    <span class="num-2"></span>%
                </div>
            </div>
            <!-- end brawser -->

            <!-- brawser -->
            <div class="p-6 flex flex-row justify-between items-center text-gray-600 border-b">
                <div class="flex items-center">
                    <i class="fab fa-firefox mr-4"></i>
                    <h1>firefox</h1>
                </div>
                <div>
                    <span class="num-2"></span>%
                </div>
            </div>
            <!-- end brawser -->

            <!-- brawser -->
            <div class="p-6 flex flex-row justify-between items-center text-gray-600 border-b">
                <div class="flex items-center">
                    <i class="fab fa-internet-explorer mr-4"></i>
                    <h1>internet explorer</h1>
                </div>
                <div>
                    <span class="num-2"></span>%
                </div>
            </div>
            <!-- end brawser -->

            <!-- brawser -->
            <div class="p-6 flex flex-row justify-between items-center text-gray-600 border-b-0">
                <div class="flex items-center">
                    <i class="fab fa-safari mr-4"></i>
                    <h1>safari</h1>
                </div>
                <div>
                    <span class="num-2"></span>%
                </div>
            </div>
            <!-- end brawser -->

        </div>
        <!-- end Browser Stats -->




    </div> --}}
    <script src="{{ $chart->cdn() }}"></script>
    <script src="{{ $historyRequestChart->cdn() }}"></script>

    {{ $chart->script() }}
    {{ $historyRequestChart->script() }}
@endsection
