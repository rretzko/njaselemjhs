<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Reports: Participants') }}
        </h2>

        <div class="text-lg mt-4">
            <a href="{{ route('dashboard') }}" class="text-indigo-500">
                Dashboard
            </a>
            -
            <a href="{{ route('administration.index') }}" class="text-indigo-500">
                Administration
            </a>
            -
            <a href="{{ route('administration.reports') }}" class="text-indigo-500">
                Reports
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                @foreach($events AS $event)
                    @if($event->id > 1) {{-- Start with 2022 event --}}
                        <div>
                            <header class="font-bold">{{ $event->short_name}}</header>
                            <ul class="ml-12 text-lg list-disc">
                                @foreach($ensembles AS $ensemble)
                                    <li>
                                        <a href="{{ route('administration.reports.participants.ensemble',['event' => $event, 'ensemble' => $ensemble]) }}"
                                            class="text-indigo-500"
                                        >
                                            {{ $ensemble->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
