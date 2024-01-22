@extends('layouts.back-end.main')

@section('css')
    <!-- MIDTRANS CLIENT KEY -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-ZIuQ4BWKiqlM1TO0"></script>
@endsection

@section('content')
    <!-- Main content -->
    <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
        </div>

        <!-- Content -->
        <div class="mt-2">
            <!-- State cards -->
            @can('isMember')
                <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-3">
                    <!-- Value card -->
                    @if ($saldo->status_akun === 'Calon Member')
                        <form method="POST" action="{{ url('deposit-store?ref=' . request('ref')) }}" class="space-y-6">
                            @csrf
                            <input
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                                type="hidden" name="nominal" value="75000" required autofocus />

                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <h6
                                        class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                        Bayar Biaya Registrasi
                                    </h6>
                                    <span class="text-xl font-semibold">Rp 75,000</span>
                                </div>
                                <div>
                                    <span>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 11 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M1.75 15.363a4.954 4.954 0 0 0 2.638 1.574c2.345.572 4.653-.434 5.155-2.247.502-1.813-1.313-3.79-3.657-4.364-2.344-.574-4.16-2.551-3.658-4.364.502-1.813 2.81-2.818 5.155-2.246A4.97 4.97 0 0 1 10 5.264M6 17.097v1.82m0-17.5v2.138" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                    Payment
                                </button>
                            </div>
                        </form>
                    @else
                        <a href="{{ url('saldo?ref=' . request('ref')) }}"
                            class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                            <div>
                                <h6
                                    class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                    Saldo
                                </h6>
                                <span class="text-xl font-semibold">Rp {{ number_format($saldoEnd) }}</span>
                            </div>
                            <div>
                                <span>
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 11 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M1.75 15.363a4.954 4.954 0 0 0 2.638 1.574c2.345.572 4.653-.434 5.155-2.247.502-1.813-1.313-3.79-3.657-4.364-2.344-.574-4.16-2.551-3.658-4.364.502-1.813 2.81-2.818 5.155-2.246A4.97 4.97 0 0 1 10 5.264M6 17.097v1.82m0-17.5v2.138" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endif

                    <!-- Orders card -->
                    <a href="javascript:void(0);" onclick="copyLink()"
                        class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                        <div>
                            <h6
                                class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                Share
                            </h6>
                        </div>
                        <div>
                            <span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m5.953 7.467 6.094-2.612m.096 8.114L5.857 9.676m.305-1.192a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0ZM17 3.84a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0Zm0 10.322a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0Z" />
                                </svg>
                            </span>
                        </div>
                    </a>
                    <input type="text" value="{{ 'http://localhost:8000/register?ref=' . request('ref') }}"
                        id="shareLinkInput" style="display: none;">
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-12">
                    <!-- Bar chart card -->
                    <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Market Plan</h4>
                        </div>
                        <!-- Chart -->
                        <div class="relative p-4 h-72">
                            <h3>Market Plan</h3>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-12">
                    <!-- Bar chart card -->
                    <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Product List</h4>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                    <!-- Active users chart -->
                    <div class="col-span-1 bg-white rounded-md dark:bg-darker"
                        style="background-image: url('{{ asset('assets/back-end/images/cover.jpg') }}'); background-size: cover; background-position: center;">
                        <!-- Content -->
                        <div class="relative p-4 h-72">
                            <div class="p-4 h-72 z-10 flex flex-col items-center justify-end h-full relative">
                                <h2 class="text-2xl font-bold text-white text-center">Nama Produk</h2>
                                <div class="absolute" style="bottom: 0">
                                    <p class="text-lg text-white text-center">Harga: Rp 100.000</p>
                                    <button class="bg-blue-500 border border-blue-700 text-white px-4 py-2 rounded-md">
                                        Beli Sekarang &#10150;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Line chart card -->
                    <div class="col-span-4 bg-white rounded-md dark:bg-darker"
                        style="background-image: url('{{ asset('assets/back-end/images/cover.jpg') }}'); background-size: cover; background-position: center;">
                        <!-- Card header -->
                        <div class="relative p-4 h-72">
                            <div class="p-4 h-72 z-10 flex flex-col items-center justify-end h-full relative">
                                <h2 class="text-2xl font-bold text-white text-center">Nama Produk</h2>
                                <div class="absolute" style="bottom: 0">
                                    <p class="text-lg text-white text-center">Harga: Rp 100.000</p>
                                    <button class="bg-blue-500 border border-blue-700 text-white px-4 py-2 rounded-md">
                                        Beli Sekarang &#10150;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 bg-white rounded-md dark:bg-darker"
                        style="background-image: url('{{ asset('assets/back-end/images/cover.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="relative p-4 h-72">
                            <div class="p-4 h-72 z-10 flex flex-col items-center justify-end h-full relative">
                                <h2 class="text-2xl font-bold text-white text-center">Nama Produk</h2>
                                <div class="absolute" style="bottom: 0">
                                    <p class="text-lg text-white text-center">Harga: Rp 100.000</p>
                                    <button class="bg-blue-500 border border-blue-700 text-white px-4 py-2 rounded-md">
                                        Beli Sekarang &#10150;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 bg-white rounded-md dark:bg-darker"
                        style="background-image: url('{{ asset('assets/back-end/images/cover.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="relative p-4 h-72">
                            <div class="p-4 h-72 z-10 flex flex-col items-center justify-end h-full relative">
                                <h2 class="text-2xl font-bold text-white text-center">Nama Produk</h2>
                                <div class="absolute" style="bottom: 0">
                                    <p class="text-lg text-white text-center">Harga: Rp 100.000</p>
                                    <button class="bg-blue-500 border border-blue-700 text-white px-4 py-2 rounded-md">
                                        Beli Sekarang &#10150;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 bg-white rounded-md dark:bg-darker"
                        style="background-image: url('{{ asset('assets/back-end/images/cover.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="relative p-4 h-72">
                            <div class="p-4 h-72 z-10 flex flex-col items-center justify-end h-full relative">
                                <h2 class="text-2xl font-bold text-white text-center">Nama Produk</h2>
                                <div class="absolute" style="bottom: 0">
                                    <p class="text-lg text-white text-center">Harga: Rp 100.000</p>
                                    <button class="bg-blue-500 border border-blue-700 text-white px-4 py-2 rounded-md">
                                        Beli Sekarang &#10150;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 bg-white rounded-md dark:bg-darker"
                        style="background-image: url('{{ asset('assets/back-end/images/cover.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="relative p-4 h-72">
                            <div class="p-4 h-72 z-10 flex flex-col items-center justify-end h-full relative">
                                <h2 class="text-2xl font-bold text-white text-center">Nama Produk</h2>
                                <div class="absolute" style="bottom: 0">
                                    <p class="text-lg text-white text-center">Harga: Rp 100.000</p>
                                    <button class="bg-blue-500 border border-blue-700 text-white px-4 py-2 rounded-md">
                                        Beli Sekarang &#10150;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('isAdmin')
                <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-3">
                    <!-- Value card -->
                    <a href="#" class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                        <div>
                            <h6
                                class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                                Member
                            </h6>
                            <span class="text-xl font-semibold">{{ $allUser }}</span>
                        </div>
                        <div>
                            <span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4.333 6.764a3 3 0 1 1 3.141-5.023M2.5 16H1v-2a4 4 0 0 1 4-4m7.379-8.121a3 3 0 1 1 2.976 5M15 10a4 4 0 0 1 4 4v2h-1.761M13 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                </svg>
                            </span>
                        </div>
                    </a>
                </div>
                <!-- Charts -->
                <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                    <!-- Bar chart card -->
                    <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Bar Chart</h4>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 dark:text-light">Last year</span>
                                <button class="relative focus:outline-none" x-cloak
                                    @click="isOn = !isOn; $parent.updateBarChart(isOn)">
                                    <div
                                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                                    </div>
                                    <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                        :class="{
                                            'translate-x-0  bg-white dark:bg-primary-100': !
                                                isOn,
                                            'translate-x-6 bg-primary-light dark:bg-primary': isOn
                                        }">
                                    </div>
                                </button>
                            </div>
                        </div>
                        <!-- Chart -->
                        <div class="relative p-4 h-72">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>

                    <!-- Doughnut chart card -->
                    <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Doughnut Chart</h4>
                            <div class="flex items-center">
                                <button class="relative focus:outline-none" x-cloak
                                    @click="isOn = !isOn; $parent.updateDoughnutChart(isOn)">
                                    <div
                                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                                    </div>
                                    <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                        :class="{
                                            'translate-x-0  bg-white dark:bg-primary-100': !
                                                isOn,
                                            'translate-x-6 bg-primary-light dark:bg-primary': isOn
                                        }">
                                    </div>
                                </button>
                            </div>
                        </div>
                        <!-- Chart -->
                        <div class="relative p-4 h-72">
                            <canvas id="doughnutChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Two grid columns -->
                <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                    <!-- Active users chart -->
                    <div class="col-span-1 bg-white rounded-md dark:bg-darker">
                        <!-- Card header -->
                        <div class="p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Active users right
                                now</h4>
                        </div>
                        <p class="p-4">
                            <span class="text-2xl font-medium text-gray-500 dark:text-light" id="usersCount">0</span>
                            <span class="text-sm font-medium text-gray-500 dark:text-primary">Users</span>
                        </p>
                        <!-- Chart -->
                        <div class="relative p-4">
                            <canvas id="activeUsersChart"></canvas>
                        </div>
                    </div>

                    <!-- Line chart card -->
                    <div class="col-span-4 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Line Chart</h4>
                            <div class="flex items-center">
                                <button class="relative focus:outline-none" x-cloak
                                    @click="isOn = !isOn; $parent.updateLineChart()">
                                    <div
                                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                                    </div>
                                    <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                        :class="{
                                            'translate-x-0  bg-white dark:bg-primary-100': !
                                                isOn,
                                            'translate-x-6 bg-primary-light dark:bg-primary': isOn
                                        }">
                                    </div>
                                </button>
                            </div>
                        </div>
                        <!-- Chart -->
                        <div class="relative p-4 h-72">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                    <div class="col-span-4 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                        <!-- Card header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Line Chart</h4>
                            <div class="flex items-center">
                                <button class="relative focus:outline-none" x-cloak
                                    @click="isOn = !isOn; $parent.updateLineChart()">
                                    <div
                                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                                    </div>
                                    <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                                        :class="{
                                            'translate-x-0  bg-white dark:bg-primary-100': !
                                                isOn,
                                            'translate-x-6 bg-primary-light dark:bg-primary': isOn
                                        }">
                                    </div>
                                </button>
                            </div>
                        </div>
                        <!-- Chart -->
                        <div class="relative p-4 h-72">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </main>
@endsection

@push('js')
    <script>
        function copyLink() {
            var copyText = document.getElementById("shareLinkInput");
            copyText.style.display = "block"; // Show the input field
            copyText.select();
            document.execCommand("copy");
            copyText.style.display = "none"; // Hide the input field again
            alert("Link copied to clipboard!");
        }
    </script>
@endpush
