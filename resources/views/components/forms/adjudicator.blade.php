@props([
    'adjudicators',
    'directors',
    'ensembles',
    'event',
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
                            System Id: {{ ($adjudicator) ? $adjudicator->id : 'New' }}
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
                                @foreach($ensembles AS $ensemble)
                                    <option value="{{ $ensemble->id }}">{{ $ensemble->descr }}</option>
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
                                @foreach($rooms AS $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
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
                                @foreach($voiceparts AS $voicepart)
                                    <option value="{{ $voicepart->id }}">{{ $voicepart->descr }}</option>
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
                                @foreach($directors AS $director)
                                    <option value="{{ $director->user_id }}">{{ $director->fullnameAlpha }}</option>
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
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
