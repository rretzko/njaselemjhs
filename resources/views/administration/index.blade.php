<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Main Menu') }}
        </h2>

        <div class="text-lg mt-4">
            <a href="{{ route('dashboard') }}" class="text-indigo-500">
                Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                <ol>
                    <li>
                        <a href="{{ route('administration.upload.directors') }}">
                            Upload Directors csv from NJACDA.com
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('administration.upload.students') }}">
                            Upload Students csv from NJACDA.com
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('administration.directors') }}">
                            Directors
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</x-app-layout>
