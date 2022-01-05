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

            {{-- AUDITIONs --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                <div>
                    <div class="flex row">
                        <label>Students</label>
                        <div class="data">{{ $adjudicator ? $adjudicator->students()->count() : 'No adjudication found'}}</div>
                    </div>
                    <div class="mb-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" colspan="2"></th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border border-l-4 " colspan="3" >VOCALISE</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border border-l-4" colspan="4" >SOLO</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-l-4" colspan="2"></th>
                            </tr>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border ">###</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border ">mp3</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border-l-4" title="Vocal Quality">VQ</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center" title="Intonation">I</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center" title="Vocalise Subtotal">Sub</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border-l-4" title="Vocal Quality">VQ</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center" title="Intonation">I</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center" title="Musicianship">M</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center " title="Vocalise Subtotal">Sub</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-l-4" title="Overall Total">Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-l-4">Submit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($adjudicator->students() AS $student)
                                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                    <form method="post" action="{{ route('adjudication.update', ['student' => $student]) }}">
                                        @csrf
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center border-l-4">
                                            <audio controls>
                                                <source src="{{ $student->mp3 }}" type="audio/mpeg">
                                                Your browser does not support the audio element
                                            </audio>
                                            @error('mp3') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 border-l-4" title="Vocal Quality">
                                            <select name="scores[]">
                                                @for($i=1; $i<10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900" title="Intonation">
                                            <select name="scores[]">
                                                @for($i=1; $i<10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center" title="Vocalise Subtotal">
                                            ***
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 border-l-4" title="Vocal Quality">
                                            <select name="scores[]">
                                                @for($i=1; $i<10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900" title="Intonation">
                                            <select name="scores[]">
                                                @for($i=1; $i<10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900" title="Musicianship">
                                            <select name="scores[]">
                                                @for($i=1; $i<10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center" title="Vocalise Subtotal">
                                            ***
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center border-l-4" title="Overall Total">
                                            *****
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 border-l-4">
                                            <button type="submit"
                                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Save
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No auditions found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
