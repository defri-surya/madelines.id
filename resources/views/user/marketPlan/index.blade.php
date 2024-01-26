@extends('layouts.back-end.main')

@section('content')
    <!-- Main content -->
    <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Marketing Plan</h1>
        </div>

        <!-- Content -->
        <div class="mt-2">
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-12 lg:space-y-0 lg:grid-cols-12">
                <!-- Bar chart card -->
                <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                    <!-- Card header -->
                    {{-- <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                        <a href="{{ url('marketplan-create?ref=' . request('ref')) }}"
                            class="w-30 px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                            Tambah Marketing Plan
                        </a>
                    </div> --}}
                    <!-- Chart -->
                    <div class="relative p-4">
                        @forelse ($marketPlan as $item)
                            <img src="{{ asset($item->foto) }}" alt="">
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
