@props([
    'adjudicators',
    'directors',
    'ensemble',
    'ensembles',
    'event',
    'room',
    'rooms',
    'route',
    'voiceparts',
    'adjudicator' => false,
])

<form class="space-y-8 divide-y divide-gray-200 px-2" method="post"
      action="{{ route($route, (($adjudicator) ? ['adjudicator' => $adjudicator] : ['event'=> $event])) }}">

    @csrf

    <div class="space-y-8 divide-y divide-gray-200">

        <div class="pt-1">

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div id="labels" class="flex row mb-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">
                            System Id: {{ ($room && $room->id) ? $room->id : 'New' }}
                        </label>
                    </div>
                </div>
            </div>

            {{-- EVENT NAME --}}
            <div class="mt-6 ">
                <div id="labels" class=" mb-4">
                    <div style="">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Event: {{ $event->name }}
                        </label>
                    </div>
                </div>
            </div>

            {{-- ENSEMBLE --}}
            <div class="mt-6 ">
                <div id="labels" class=" mb-4">
                    <div style="">
                        <label for="ensemble_id" class="block text-sm font-medium text-gray-700">
                            Ensemble
                        </label>
                        <div style="" class="mt-1">
                            <select name="ensemble_id">
                                @foreach($ensembles AS $selectensemble)
                                    <option value="{{ $ensemble->id }}"
                                        @if($ensemble && $ensemble->id && ($ensemble->id === $selectensemble->id)) selected @endif
                                    >
                                        {{ $selectensemble->descr }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ensemble_id')
                            <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ROOMS--}}
            <div class="mt-6 ">
                <div id="labels" class=" mb-4">
                    <div style="">
                        <label for="room_id" class="block text-sm font-medium text-gray-700">
                            Room
                        </label>
                        <div style="" class="mt-1">
                            <select name="room_id">
                                @foreach($rooms AS $selectroom)
                                    <option value="{{ $selectroom->id }}"
                                        @if($room && $room->id && ($room->id === $selectroom->id)) selected @endif
                                    >
                                        {{ $selectroom->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                            <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- VOICEPARTS--}}
            <div class="mt-6 ">
                <div id="labels" class=" mb-4">
                    <div style="">
                        <label for="voicepartids" class="block text-sm font-medium text-gray-700">
                            Voice Part(s)
                        </label>
                        <div style="" class="mt-1">
                            <select name="voiceparts[]" multiple>
                                @foreach($voiceparts AS $selectvoicepart)
                                    <option value="{{ $selectvoicepart->id }}"
                                        @if($room && $room->id && $room->adjudicators->count() &&
                                            $room->adjudicators[0]->voicepart->id === $selectvoicepart->id)
                                            selected
                                        @endif
                                    >
                                        {{ $selectvoicepart->descr }}
                                    </option>
                                @endforeach
                            </select>
                            @error('voiceparts')
                            <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- DIRECTORS--}}
            <div class="mt-6 ">
                <div id="labels" class=" mb-4">
                    <div style="">
                        <label for="directorids" class="block text-sm font-medium text-gray-700">
                            Directors
                        </label>
                        <div style="" class="mt-1">
                            <select name="directors[]" multiple>
                                @foreach($directors AS $selectdirector)
                                    <option value="{{ $selectdirector->user_id }}"
                                        @if($room && $room->id &&
                                            $room->adjudicators->contains('user_id',$selectdirector->user_id))
                                            selected
                                        @endif
                                    >
                                        {{ $selectdirector->fullnameAlpha }}
                                    </option>
                                @endforeach
                            </select>
                            @error('directors')
                            <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="pt-5 mb-4">
                <div class="flex justify-end">
                    <button type="button"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                    <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        @if($room && $room->id) Update @else Save @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
