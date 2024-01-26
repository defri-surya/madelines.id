@extends('layouts.back-end.main')

@section('content')
    <!-- Main content -->
    <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Tambah Produk</h1>
        </div>

        <!-- Content -->
        <div class="mt-2">
            <!-- Charts -->
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-12 lg:space-y-0 lg:grid-cols-12">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Tambah Produk</h4>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4">
                        <form method="POST" action="{{ url('produk-store?ref=' . request('ref')) }}" class="space-y-6"
                            enctype="multipart/form-data">
                            @csrf

                            <input
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker @error('foto') is-invalid @enderror"
                                type="file" name="foto" />
                            <label for="">
                                <b style="color:red; font-size:14px">*</b><b style="font-size:12px"><i>Max Size
                                        1 MB</i></b>
                            </label>
                            @error('foto')
                                <div class="alert alert-danger">
                                    Ukuran gambar tidak boleh lebih dari 1 MB!
                                </div>
                            @enderror

                            <input
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                                type="text" name="title" placeholder="Nama Produk" required autofocus />

                            <input
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                                type="number" name="harga" placeholder="Harga" required autofocus />

                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                    Publish
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
