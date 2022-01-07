<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adjudication: Main Menu') }}
        </h2>

        <div class="text-lg mt-4">
            <a href="{{ route('dashboard') }}" class="text-indigo-500">
                Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- PAGE HEADER --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 mb-4">
                <div>
                    <style>
                        label{width: 8rem;}
                        .data{font-weight: bold;}
                    </style>
                    <div class="flex row">
                        <label>Event</label>
                        <div class="data">{{ $adjudicator ? $adjudicator->event->name : 'No adjudication found'}}</div>
                    </div>
                </div>
                <div>
                    <div class="flex row">
                        <label>Ensemble</label>
                        <div class="data">{{ $adjudicator ? $adjudicator->ensemble->descr : 'No adjudication found'}}</div>
                    </div>
                </div>
                <div>
                    <div class="flex row">
                        <label>Room</label>
                        <div class="data">{{ $adjudicator ? $adjudicator->room->name : 'No adjudication found'}}</div>
                    </div>
                </div>
            </div>

            {{-- AUDITIONS --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                <div>
                    <div class="flex row">
                        <label>Students</label>
                        <div class="data">{{ $adjudicator ? $adjudicator->students()->count() : 'No adjudication found'}}</div>
                    </div>
                    <div class="flex row flex-wrap space-x-4 space-y-1 mb-4">
                        @forelse($adjudicator->students() AS $token)
                            <div>
                                <a href="{{ route('adjudication.show', ['adjudicator' => $adjudicator, 'student' => $token]) }}" class=" ">
                                    <button class="bg-indigo-50 border rounded-full px-1"
                                            style="background-color: {{ $token->toleranceBackgroundColor }}"
                                    >
                                        {{ $token->id }}
                                    </button>
                                </a>

                            </div>
                        @empty
                            <div>
                                No students found
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
