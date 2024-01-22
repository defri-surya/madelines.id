@extends('layouts.back-end.main')

@section('content')
    <!-- Main content -->
    <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Withdraw</h1>
        </div>

        <!-- Content -->
        <div class="mt-2">
            <!-- State cards -->
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-12 lg:space-y-0 lg:grid-cols-12">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Proses</h4>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4">
                        <table class="w-full table-auto">
                            <tbody>
                                @forelse ($WDProses as $item)
                                    <tr>
                                        <td>{{ $item->kode_wd }}</td>
                                        <td>{{ $item->no_rekening }} a/n {{ $item->atas_nama }}</td>
                                        <td>Rp {{ number_format($item->nominal) }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->tgl_wd)->format('d-m-Y') }}</td>
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
                                        <td>
                                            <form
                                                action="{{ url('withdraw-konfirm/' . $item->kode_wd . '/?ref=' . request('ref')) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit"
                                                    class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                                    Konfirmasi
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="5" class="text-center">
                                        Belum ada pengajuan withdraw !
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-12 lg:space-y-0 lg:grid-cols-12">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Sukses</h4>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4">
                        <table class="w-full table-auto">
                            <tbody>
                                @forelse ($WDSukses as $item)
                                    <tr>
                                        <td>{{ $item->kode_wd }}</td>
                                        <td>{{ $item->no_rekening }} a/n {{ $item->atas_nama }}</td>
                                        <td>Rp {{ number_format($item->nominal) }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->tgl_wd)->format('d-m-Y') }}</td>
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
                                        Belum ada withdraw yang terkonfirmasi !
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
