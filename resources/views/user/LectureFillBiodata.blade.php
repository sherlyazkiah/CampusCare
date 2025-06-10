@extends('layouts.app')
@section('content')
<div class="p-4 m-40 mr-60 ml-60 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="text-center mb-10 text-xl font-semibold dark:text-white">Lecture Biodata</h3>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('lecture.biodata.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-6 gap-6">
            {{-- Name --}}
            <div class="col-span-6 sm:col-span-3">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg 
                    focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Your Full Name" required>
            </div>

            {{-- NIDN --}}
<div class="col-span-6 sm:col-span-3">
    <label for="identity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIDN</label>
    <input type="text" name="identity" id="identity" value="{{ old('identity') }}"
        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg 
        focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 
        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
        dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Input your NIDN" required>
</div>


            {{-- Username (readonly dari Auth) --}}
<div class="col-span-6 sm:col-span-3">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
    <p class="p-2 bg-gray-100 rounded text-gray-600">{{ Auth::user()->username }}</p>
</div>

            {{-- Email --}}
            <div class="col-span-6 sm:col-span-3">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg 
                    focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                    dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="example@company.com" required>
            </div>
            


            

            {{-- Password (readonly) --}}
            <div class="col-span-6 sm:col-span-3">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password"
                    class="shadow-sm bg-gray-100 border border-gray-300 text-gray-500 sm:text-sm rounded-lg 
                    block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                    placeholder="••••••••" readonly>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end col-span-6 sm:col-full">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
                    font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
