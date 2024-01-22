@extends('layouts.back-end.main')

@section('content')
    <!-- Main content -->
    <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Saldo</h1>
        </div>

        <!-- Content -->
        <div class="mt-2">
            <!-- State cards -->
            <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-12 xl:grid-cols-12">
                <!-- Value card -->
                <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                    <div>
                        <h6
                            class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                            Saldo
                        </h6>
                        <span class="text-xl font-semibold">Rp {{ number_format($saldoEnd) }}</span>
                        {{-- <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                            +4.4%
                        </span> --}}
                    </div>
                    <div>
                        <a href="{{ url('deposit?ref=' . request('ref')) }}" class="flex items-center">
                            <span class="text-xl font-semibold mr-2">Deposit</span>
                            <span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                    <path
                                        d="M17 0h-5.768a1 1 0 1 0 0 2h3.354L8.4 8.182A1.003 1.003 0 1 0 9.818 9.6L16 3.414v3.354a1 1 0 0 0 2 0V1a1 1 0 0 0-1-1Z" />
                                    <path
                                        d="m14.258 7.985-3.025 3.025A3 3 0 1 1 6.99 6.768l3.026-3.026A3.01 3.01 0 0 1 8.411 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V9.589a3.011 3.011 0 0 1-1.742-1.604Z" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-12 lg:space-y-0 lg:grid-cols-12">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Riwayat</h4>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4">
                        <table class="w-full table-auto">
                            <tbody>
                                @forelse ($transaksi as $item)
                                    <tr>
                                        <td>
                                            @if ($item->income != null)
                                                Rp {{ number_format($item->income) }}
                                            @endif
                                            @if ($item->expenditure != null)
                                                Rp {{ number_format($item->expenditure) }}
                                            @endif
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($item->tgl)->format('d-m-Y') }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            @if ($item->status === 'Proses')
                                                <span
                                                    class="inline-block px-2 py-px ml-2 text-md text-orange-500 bg-orange-100 rounded-md">
                                                    {{ $item->status }}
                                                </span>
                                            @elseif ($item->status === 'Sukses')
                                                <span
                                                    class="inline-block px-2 py-px ml-2 text-md text-green-500 bg-green-100 rounded-md">
                                                    + {{ $item->status }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-block px-2 py-px ml-2 text-md text-red-500 bg-red-100 rounded-md">
                                                    {{ $item->status }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="5" class="text-center">
                                        Belum ada riwayat pendapatan !
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
