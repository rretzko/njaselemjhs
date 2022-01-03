@props([
    'event',
    'ensembles' ,
    'route'
])

<form class="space-y-8 divide-y divide-gray-200" method="post"
      action="{{ route($route,['event' => $event] ) }}">

    @csrf

    <div class="space-y-8 divide-y divide-gray-200">

        <div class="pt-1">

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div id="labels" class="flex row mb-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">
                            System Id: {{ ($event) ? $event->id : 'New' }}
                        </label>
                    </div>
                </div>
            </div>

            {{-- NAME --}}
            <div class="mt-6 ">
                <div id="labels" class="flex row mb-4">
                    <div>
                        <label for="user_id" class="block text-lg font-medium text-gray-700">
                            Event: <b>{{ $event->name }}</b>
                        </label>
                    </div>
                </div>
            </div>

            {{-- DATES --}}
            <div class="mt-1 ">
                <div id="labels" class="flex row mb-4">
                    <div>
                        <label for="user_id" class="block text-lg font-medium text-gray-700">
                            Dates: <b>{{ $event->startDateMmmDdYYYY }} - {{ $event->endDateMmmDdYYYY }}</b>
                        </label>
                    </div>
                </div>
            </div>

            {{-- ENSEMBLES ---}}
            <div class="mt-1 ">
                <div id="labels" class="flex row mb-4">
                    <div>
                        <label for="user_id" class="block text-md font-medium text-gray-700">
                            Ensembles
                            @error('checkboxes')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </label>
                        <div>
                            @foreach($ensembles AS $key=>$ensemble)
                                <div>
                                    <label>
                                        <input type="checkbox" value="{{ $ensemble->id }}" name="checkboxes[{{ $key }}]"
                                            @if($event->ensembles->contains($ensemble->id)) checked @endif
                                        />
                                        {{ $ensemble->descr }}
                                        <span class="text-sm">(
                                        @foreach($ensemble->voiceparts AS $voicepart)
                                            {{ $voicepart->descr }} @if(! $loop->last), @endif
                                        @endforeach
                                        )</span>
                                    </label>
                                </div>
                            @endforeach
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
