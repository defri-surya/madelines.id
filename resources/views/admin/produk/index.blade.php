@extends('layouts.back-end.main')

@section('content')
    <!-- Main content -->
    <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Produk</h1>
        </div>

        <!-- Content -->
        <div class="mt-2">
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-12 lg:space-y-0 lg:grid-cols-12">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <a href="{{ url('produk-create?ref=' . request('ref')) }}"
                            class="w-30 px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                            Tambah Produk
                        </a>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4">
                        <table class="w-full table-auto" style="overflow-x: auto">
                            <tbody>
                                @forelse ($produk as $item)
                                    <tr>
                                        <td>
                                            @if ($item->foto === null)
                                                <img src="{{ asset('assets') }}/images/noimage.png" alt=""
                                                    class="w-150 h-150 img-fluid border rounded-full">
                                            @else
                                                <img src="{{ asset($item->foto) }}" alt=""
                                                    class="w-20 h-20 img-fluid border rounded-full">
                                            @endif
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>
                                            <a href="{{ url('produk-edit/' . $item->id . '/?ref=' . request('ref')) }}"
                                                class="w-30 px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                                Edit
                                            </a>
                                            &nbsp;
                                            <form
                                                action="{{ url('produk-delete/' . $item->id . '/?ref=' . request('ref')) }}"
                                                method="POST" onsubmit="return confirm('Hapus Produk, Anda Yakin ?')"
                                                style="display: inline-block">
                                                {!! method_field('delete') . csrf_field() !!}
                                                <button
                                                    class="w-30 px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker"
                                                    type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="5" class="text-center">
                                        Belum ada produk !
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
