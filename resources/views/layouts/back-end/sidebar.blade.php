<!-- Sidebar -->
<aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
    <div class="flex flex-col h-full">
        <!-- Sidebar links -->
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <!-- Dashboards links -->
            <div x-data="{ isActive: true, open: true }">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="{{ url('dashboard?ref=' . request('ref')) }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm"> Dashboards </span>
                </a>
            </div>

            @can('isMember')
                <!-- Authentication links -->
                @php
                    $cekRegis = App\Models\Histori::where('user_id', auth()->user()->id)
                        ->where('keterangan', 'Registrasi')
                        ->where('status', 'Sukses')
                        ->first();
                @endphp
                <!-- Components links -->
                @if ($cekRegis)
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                        <a href="{{ url('anggota?ref=' . request('ref')) }}"
                            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm"> Jaringan Anda </span>
                        </a>
                    </div>

                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                        <a href="{{ url('withdraw?ref=' . request('ref')) }}"
                            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm"> Withdraw </span>
                        </a>
                    </div>

                    <div x-data="{ isActive: false, open: false }">
                        <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                        <a href="{{ url('deposit?ref=' . request('ref')) }}"
                            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm"> Deposit </span>
                        </a>
                    </div>
                @else
                    <div x-data="{ isActive: false, open: false }" hidden>
                        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                        <a href="{{ url('anggota?ref=' . request('ref')) }}"
                            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm"> Jaringan Anda </span>
                        </a>
                    </div>

                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }" hidden>
                        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                        <a href="{{ url('withdraw?ref=' . request('ref')) }}"
                            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm"> Withdraw </span>
                        </a>
                    </div>

                    <div x-data="{ isActive: false, open: false }" hidden>
                        <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                        <a href="{{ url('deposit?ref=' . request('ref')) }}"
                            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm"> Deposit </span>
                        </a>
                    </div>
                @endif

                <!-- Components links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('marketing-plan?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Marketing Plan </span>
                    </a>
                </div>

                <!-- Components links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('info-perusahaan?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Info Perusahaan </span>
                    </a>
                </div>
            @endcan

            @can('isAdmin')
                <!-- Authentication links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('member?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Member </span>
                    </a>
                </div>

                <!-- Layouts links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('withdraw-admin?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Withdraw </span>
                    </a>
                </div>

                <!-- Components links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('transaksi?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Transaksi </span>
                    </a>
                </div>

                <!-- Components links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('transaksi?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Transaksi Produk </span>
                    </a>
                </div>

                <!-- Components links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('produk?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Produk </span>
                    </a>
                </div>

                <!-- Components links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('marketplan?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Marketing Plan </span>
                    </a>
                </div>

                <!-- Components links -->
                <div x-data="{ isActive: false, open: false }">
                    <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                    <a href="{{ url('info?ref=' . request('ref')) }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <span class="ml-2 text-sm"> Info Perusahaan </span>
                    </a>
                </div>
            @endcan
        </nav>
    </div>
</aside>
