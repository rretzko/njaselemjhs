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
                                        Events
                                    </h2>
                                    <a href="{{ route('administration.events.create') }}">
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
                                            Name (Click to edit)
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Short Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Dates
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Dashboard
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Even/Odd rows -->
                                    @foreach($events AS $event)
                                        <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4  text-sm font-medium text-gray-900">
                                                <a href="{{ route('administration.events.edit', ['event' => $event]) }}"
                                                   class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    {{ $event->name }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $event->short_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $event->start_dateMmmDdYyyy }}<br />
                                                {{ $event->end_dateMmmDdYyyy }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500 ">
                                                <a href="{{ route('administration.events.ensembles.edit', ['event' => $event]) }}">
                                                    <button class="border border-black p-2 rounded bg-indigo-50"
                                                        style="width: 8rem;"
                                                    >
                                                        Ensembles ({{ $event->ensembles->count() }})
                                                    </button>
                                                </a>
                                                <a href="{{ route('administration.rooms', ['event' => $event]) }}">
                                                    <button class="border border-black p-2 rounded bg-indigo-50 "
                                                            style="width: 8rem;"
                                                    >
                                                        Rooms ({{ $event->rooms ? $event->rooms->count() : 0 }})
                                                    </button>
                                                </a>
                                                <a href="{{ route('administration.adjudicators', ['event' => $event]) }}">
                                                    <button class="border border-black p-2 rounded bg-indigo-50"
                                                            style="width: 8rem;"
                                                    >
                                                        Adjudicators ({{ $event->adjudicators ? $event->adjudicators->count() : 0 }})
                                                    </button>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach

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
