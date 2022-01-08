<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Adjudicators') }}
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
            <a href="{{ route('administration.events') }}" class="text-indigo-500">
                Events
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
                                        Adjudicators for: {{ $event->name }}
                                    </h2>
                                    <a href="{{ route('administration.adjudicators.create', ['event' => $event]) }}">
                                        <button class="bg-indigo-50 border border-black rounded p-2 text-sm">
                                            Add
                                        </button>
                                    </a>
                                </div>
                                <div id="form_and_table" class="flex row w-full ">
                                    <div class="">

                                        <x-forms.adjudicator
                                            :adjudicators=$adjudicators
                                            :directors=$directors
                                            :ensemble=$ensemble
                                            :ensembles=$ensembles
                                            :event=$event
                                            :room=$room
                                            :rooms=$rooms
                                            :voiceparts=$voiceparts
                                            route="administration.adjudicators.store"
                                        />

                                    </div>
                                    <div class="">
                                        {!! $table !!}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
