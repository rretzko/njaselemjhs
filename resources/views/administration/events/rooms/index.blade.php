<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Rooms') }}
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
                                        Rooms for: {{ $event->name }}
                                    </h2>
                                    <a href="{{ route('administration.rooms.create', ['event' => $event]) }}">
                                        <button class="bg-indigo-50 border border-black rounded p-2 text-sm">
                                            Add
                                        </button>
                                    </a>
                                </div>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ###
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Include
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name (Click to edit)
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <form method="post" action="{{ route('administration.rooms.update', ['event' => $event]) }}">

                                        @csrf

                                        <!-- Even/Odd rows -->
                                        @foreach($rooms AS $room)
                                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900 ">
                                                    <input type="checkbox" name="rooms[]" id="room_{{ $room->id }}"
                                                           value="{{ $room->id }}"
                                                           @if($event->rooms->contains($room)) checked @endif
                                                    />
                                                </td>
                                                <td class="px-6 py-4  text-sm font-medium text-gray-900">
                                                    <a href="{{ route('administration.rooms.edit', ['room' => $room]) }}"
                                                       class="text-indigo-600 hover:text-indigo-900"
                                                    >
                                                        {{ $room->name }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td></td>
                                            <td colspan="2" >
                                                <button type="submit"
                                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Save
                                                </button>
                                            </td>
                                        </tr>

                                    </form>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
