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
            <h1 class="text-2xl font-semibold">Deposit</h1>
        </div>

        <!-- Content -->
        <div class="mt-2">
            <!-- Charts -->
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-12 lg:space-y-0 lg:grid-cols-12">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Nominal Deposite</h4>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4">
                        <form method="POST" action="{{ url('deposit-store?ref=' . request('ref')) }}" class="space-y-6">
                            @csrf

                            <input
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                                type="number" name="nominal" placeholder="Minimal deposit Rp 50.000" min="50000"
                                required autofocus />
                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                    Payment
                                </button>
                            </div>
                        </form>
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
                                        <td>+ Rp {{ number_format($item->nominal) }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->tgl_payment)->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($item->status_payment === 'Proses')
                                                <span
                                                    class="inline-block px-2 py-px ml-2 text-md text-orange-500 bg-orange-100 rounded-md">
                                                    {{ $item->status_payment }}
                                                </span>
                                            @elseif ($item->status_payment === 'Sukses')
                                                <span
                                                    class="inline-block px-2 py-px ml-2 text-md text-green-500 bg-green-100 rounded-md">
                                                    + {{ $item->status_payment }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-block px-2 py-px ml-2 text-md text-red-500 bg-red-100 rounded-md">
                                                    {{ $item->status_payment }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="5" class="text-center">
                                        Belum ada riwayat transaksi !
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
