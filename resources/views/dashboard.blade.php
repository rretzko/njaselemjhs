<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                <ul>
                    @if((auth()->id() === 1) || (auth()->id() === 66))
                        <li>
                            <a href="{{ route('administration.index') }}">
                                Administration
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('adjudication.index') }}">
                            Adjudication
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
