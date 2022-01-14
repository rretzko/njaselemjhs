<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if((auth()->id() === 1) || (auth()->id() === 9)) {{-- Retzko & Reiser --}}
                {!! $ensemblesummarytable !!}
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                <ul>
                    @if((auth()->id() === 1) || (auth()->id() === 9)) {{-- Retzko & Reiser --}}
                        <li>
                            <a href="{{ route('administration.index') }}" class="text-indigo-500">
                                Administration
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('adjudication.index') }}" class="text-indigo-500">
                            Adjudication
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
