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
             -
            <a href="{{ route('administration.cutoffs.show', ['event' => $event])  }}" class="text-indigo-500">
                {{ $event->short_name }}
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
                                <div class="flex row justify-between border-b-2 mb-4">
                                    <h2 class="py-2 ">
                                        Select Cut-off scores for <b>{{ $ensemble->descr }}</b> in
                                        <b>{{ $event->short_name }}</b>
                                    </h2>
                                </div>
                                <div id="table" class="text-center" style="margin-left: 25%;">
                                    {!! $table !!}
                                </div>
                                <div id="form_and_table" class="w-full flex row justify-between px-6">
                                    @foreach($ensemble->voiceparts AS $key => $voicepart)
                                        <div class="flex flex-col text-center">
                                            <header class="font-semibold">{{ $voicepart->descr }}</header>
                                            @foreach($scores[$key] AS $detail)
                                                <a href="{{ route('administration.cutoffs.ensemble.update',
                                                        [
                                                            'event' => $event,
                                                            'ensemble' => $ensemble,
                                                            'voicepart' => $voicepart,
                                                            'score' => $detail->score,
                                                        ]) }}"
                                                   title="{{ $detail->student_id }}"
                                                   style="{{ ($cutoffs->where('voicepart_id', $voicepart->id)->first() && ($detail->score <= $cutoffs->where('voicepart_id',$voicepart->id)->first()->score)) ? 'background-color: rgba(0,255,0,.1)' : '' }}"
                                                >
                                                    {{ (int)$detail->score }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endforeach
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
