@extends('layouts.back-end.main')

@section('content')
    <!-- Main content -->
    <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Edit Marketing Plan</h1>
        </div>

        <!-- Content -->
        <div class="mt-2">
            <!-- Charts -->
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-12 lg:space-y-0 lg:grid-cols-12">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                    <!-- Card header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Edit Marketing Plan</h4>
                    </div>
                    <!-- Chart -->
                    <div class="relative p-4">
                        <form method="POST"
                            action="{{ url('marketplan-update/' . $marketplan->id . '/?ref=' . request('ref')) }}"
                            class="space-y-6" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <input
                                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker @error('foto') is-invalid @enderror"
                                type="file" name="foto" />
                            <label for="">
                                <b style="color:red; font-size:14px">*</b><b style="font-size:12px"><i>Max Size
                                        1 MB</i></b>
                            </label>
                            @if ($marketplan->foto === null)
                                <img src="{{ asset('assets') }}/images/users.png" alt=""
                                    class="w-150 h-150 img-fluid border rounded-full">
                            @else
                                <img src="{{ asset($marketplan->foto) }}" alt=""
                                    class="w-20 h-20 img-fluid border rounded-full">
                            @endif
                            @error('foto')
                                <div class="alert alert-danger">
                                    Ukuran gambar tidak boleh lebih dari 1 MB!
                                </div>
                            @enderror

                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
