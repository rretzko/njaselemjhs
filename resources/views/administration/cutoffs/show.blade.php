<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Cut-offs for: '.$event->name ) }}
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
            <a href="{{ route('administration.cutoffs')  }}" class="text-indigo-500">
                Cut-offs
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-8">
                                <div class="flex row justify-between">
                                    <h2 class="py-1">
                                        Assign Cut-off scores for {{ $event->name }}
                                    </h2>
                                </div>
                                <div id="form_and_table" class="w-full">
                                    <ul class="list-disc ml-12">
                                        <li>
                                            <a href="{{ route('administration.cutoffs.finalscores') }}" class="text-indigo-500">
                                                Update final scores
                                            </a>
                                            <span class="text-xs"> @if(session('finalScoreDate')) ({{ session('finalScoreDate') }}) @endif</span>
                                        </li>
                                        @foreach($event->ensembles AS $ensemble)
                                            <li>
                                                <a href="{{ route('administration.cutoffs.ensemble.show',
                                                    [
                                                        'event' => $event,
                                                        'ensemble' => $ensemble
                                                    ]) }}"
                                                   class="text-indigo-500"
                                                >
                                                    {{ $ensemble->descr }}
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
