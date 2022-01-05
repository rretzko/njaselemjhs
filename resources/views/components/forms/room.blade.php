@props([
    'event',
    'route',
    'room' => false,
])

<form class="space-y-8 divide-y divide-gray-200" method="post"
      action="{{ route($route,['event'=> $event, 'room' => $room] ) }}">

    @csrf

    <div class="space-y-8 divide-y divide-gray-200">

        <div class="pt-1">

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div id="labels" class="flex row mb-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">
                            System Id: {{ ($room) ? $room->id : 'New' }}
                        </label>
                    </div>
                </div>
            </div>

            {{-- NAME --}}
            <div class="mt-6 ">
                <div id="labels" class=" mb-4">
                    <div style="">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <div style="" class="mt-1">
                            <input type="text" name="name" id="name" autocomplete=""
                                   class="mr-3 @error('name') border border-gray-300 @enderror"
                                   value="{{ ($room) ? $room->ame : '' }}"
                                   style="width: 20rem;"
                            >
                            @error('name')
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
