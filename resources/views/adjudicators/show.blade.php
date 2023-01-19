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

            {{-- AUDITION TOKENS --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 mb-4">
                <div>
                    <div class="flex row">
                        <label>Students</label>
                        <div class="data">{{ $adjudicator ? $adjudicator->students()->count() : 'No adjudication found'}}</div>
                    </div>
                    <div class="flex row flex-wrap space-x-4 space-y-1 mb-4">
                        @forelse($adjudicator->students() AS $token)
                            <div>
                                <a href="{{ route('adjudication.show', ['adjudicator' => $token->eventAdjudicator, 'student' => $token]) }}" class=" ">
                                    <button class=" border rounded-full px-1" title="{{ $token->fullnameAlpha }}"
                                        style="background-color: {{ $token->toleranceBackgroundColor }}"
                                    >
                                        {!! $token->id.' <span class="text-sm">('.strtolower($token->voicepart->abbr).')</span>' !!}
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

            {{-- AUDITION --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                {{-- HEADER --}}
                <div>
                    <div class="flex row">
                        <label>Student</label>
                        <div class="data">
                            {{ $student ? $student->fullnameAlpha.' ('.$student->id.')' : 'No student found'}}
                        </div>
                    </div>
                    <div class="flex row">
                        <label>Grade</label>
                        <div class="data">{{ $student ? $student->grade : 'No student found'}}</div>
                    </div>
                    <div class="flex row">
                        <label>Voice Part</label>
                        <div class="data">{{ $student ? $adjudicator->event->short_name.' - '.$student->voicepartDescr : 'No student found'}}</div>
                    </div>
                </div>

                {{-- SCORING TABLE --}}
                <div class="mb-4">
                    <table class="min-w-full divide-y divide-gray-200 border-b-2">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" colspan="1"></th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border border-l-4 " colspan="2" >VOCALISE</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border border-l-4" colspan="3" >SOLO</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-l-4" colspan="2"></th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border ">mp3</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border-l-4" title="Vocal Quality">VQ</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center" title="Intonation">I</th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border-l-4" title="Vocal Quality">VQ</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center" title="Intonation">I</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center" title="Musicianship">M</th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-l-4" title="Overall Total">Total</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-l-4">Submit</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white">
                                <form method="post" action="{{ route('adjudication.update', ['adjudicator' => $student->eventAdjudicator, 'student' => $student]) }}">
                                    @csrf
                                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center border-l-4">
                                        <audio controls>
                                            <source src="{{ $student->mp3 }}" type="audio/mpeg">
                                            Your browser does not support the audio element
                                        </audio>
                                        @error('mp3') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 border-l-4" title="Vocal Quality">
                                        <select name="scores[]" id='vvq' onchange="updateTotal();">
                                            @for($i=1; $i<10; $i++)
                                                <option value="{{ $i }}"
                                                    @if($adjudicatorscores->count())
                                                        @if($adjudicatorscores[0]->score === $i) selected @endif
                                                    @endif
                                                >
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900" title="Intonation">
                                        <select name="scores[]" id="vi" onchange="updateTotal();">
                                            @for($i=1; $i<10; $i++)
                                                <option value="{{ $i }}"
                                                    @if($adjudicatorscores->count())
                                                        @if($adjudicatorscores[1]->score === $i) selected @endif
                                                    @endif
                                                >
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </td>

                                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 border-l-4" title="Vocal Quality">
                                        <select name="scores[]" id="svq" onchange="updateTotal();">
                                            @for($i=1; $i<10; $i++)
                                                <option value="{{ $i }}"
                                                    @if($adjudicatorscores->count())
                                                        @if($adjudicatorscores[2]->score === $i) selected @endif
                                                    @endif
                                                >
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900" title="Intonation">
                                        <select name="scores[]" id="si" onchange="updateTotal();">
                                            @for($i=1; $i<10; $i++)
                                                <option value="{{ $i }}"
                                                    @if($adjudicatorscores->count())
                                                        @if($adjudicatorscores[3]->score === $i) selected @endif
                                                    @endif
                                                >
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900" title="Musicianship">
                                        <select name="scores[]" id="sm" onchange="updateTotal();" >
                                            @for($i=1; $i<10; $i++)
                                                <option value="{{ $i }}"
                                                    @if($adjudicatorscores->count())
                                                        @if($adjudicatorscores[4]->score === $i) selected @endif
                                                    @endif
                                                >
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </td>

                                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center border-l-4"
                                        id="grandTotal"
                                        title="Overall Total"
                                    >
                                        *****
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900 border-l-4">
                                        @if($student->user_id === auth()->id())
                                            My student
                                        @else
                                            <button type="submit"
                                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Save
                                            </button>
                                        @endif
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- ADJUDICATION ROSTER --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                    {{-- HEADER --}}
                    <div>
                        <div class="flex row">
                            <div>Adjudication Roster</div>
                        </div>
                        <div>
                            <style>
                                #adjudicators td,#adjudicators th{border:1px solid black; padding:0 .25rem;}
                            </style>
                            <table class="border mb-4" id="adjudicators">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="2">Vocalise</th>
                                    <th colspan="3">Solo</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Judge</th>
                                    <th title="Vocal Quality">VQ</th>
                                    <th title="Intonation">I</th>
                                    <th title="Vocal Quality">VQ</th>
                                    <th title="Intonation">I</th>
                                    <th title="Musicanship">M</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($adjudicators AS $judge)
                                    <tr>
                                        <td title="{{ $judge->id }}">
                                            {{ $judge->director ? $judge->director->fullnameAlpha : $judge->user->name}}
                                        </td>
                                        @forelse($student->scoresByAdjudicator($judge) AS $score)
                                            <td class="text-center">{{ $score->score }}</td>
                                        @empty
                                            <td colspan="5">No scores found</td>
                                        @endforelse
                                        <td class="text-center">{{ $student->adjudicatorTotal($judge) }}</td>
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
    <script>
        window.onload = updateTotal();

        function updateTotal(){
            var total = 0;

            total = parseInt(document.getElementById('vvq').value) +
                parseInt(document.getElementById('vi').value) +
                parseInt(document.getElementById('svq').value) +
                parseInt(document.getElementById('si').value) +
                parseInt(document.getElementById('sm').value);

            document.getElementById('grandTotal').innerHTML=total;

        }
    </script>
</x-app-layout>
