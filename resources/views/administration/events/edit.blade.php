<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Events') }}
        </h2>

        <div class="text-lg mt-4">
            <a href="{{ route('dashboard') }}" class="text-indigo-500">
                Dashboard
            </a>
            -
            <a href="{{ route('administration.index')  }}" class="text-indigo-500">
                Administration
            </a>
            -
            <a href="{{ route('administration.events')  }}" class="text-indigo-500">
                Events
            </a>
        </div>
    </x-slot>

    <style>
        legend {
            background-color: rgba(97, 0, 174, .1);
            width: 100%;
            padding: 0.25rem 0.5rem;
            font-weight: bold;
            text-transform: uppercase;
            color: rgb(97, 0, 174);
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">

                <x-forms.event
                    :event=$event
                    route="administration.events.update"
                />

            </div>
        </div>
    </div>
</x-app-layout>

