<div style="display: none;">{{ set_time_limit(180) }}</div>
@foreach($ensemble->voiceparts AS $voicepart)
    <div>
        <h1 style="text-align: center;">{{ $event->short_name }}</h1>
        <h2 style="text-align: center;">{{ $ensemble->name }}</h2>
        <h3 style="text-align: center;">{{ $voicepart->descr }}</h3>
    </div>

    <style>
        table{border-collapse: collapse;margin: auto;}
        .page_break{page-break-after: always;}
        td,th{border: 1px solid black; text-align: center; padding: 0 .25rem;}
    </style>
    <table class="page_break">
        <thead>
            <tr>
                <th colspan="2" style="border: 0;"></th>
                <th colspan="6" style="border-right: 3px solid black;" >Judge 1</th>
                <th colspan="6" style="border-right: 3px solid black;" >Judge 2</th>
                <th colspan="6" style="border-right: 3px solid black;" >Judge 3</th>
                <th colspan="2" style="border: 0;"></th>
            </tr>
            <tr>
                <th colspan="2" style="border: 0;"></th>
                <th colspan="3" style="border-right: 3px solid black;" >Vocalise</th>
                <th colspan="3" style="border-right: 3px solid black;" >Solo</th>
                <th colspan="3" style="border-right: 3px solid black;" >Vocalise</th>
                <th colspan="3" style="border-right: 3px solid black;" >Solo</th>
                <th colspan="3" style="border-right: 3px solid black;" >Vocalise</th>
                <th colspan="3" style="border-right: 3px solid black;" >Solo</th>
                <th colspan="2" style="border-top: 0; border-right: 0;"></th>
            </tr>
            <tr>
                <th>Student</th>
                <th>VP</th>
                <th>Q</th>
                <th>I</th>
                <th style="border-right: 3px solid black;" >M</th>
                <th>q</th>
                <th>i</th>
                <th style="border-right: 3px solid black;" >m</th>
                <th>Q</th>
                <th>I</th>
                <th style="border-right: 3px solid black;" >M</th>
                <th>q</th>
                <th>i</th>
                <th style="border-right: 3px solid black;" >m</th>
                <th>Q</th>
                <th>I</th>
                <th style="border-right: 3px solid black;" >M</th>
                <th>q</th>
                <th>i</th>
                <th style="border-right: 3px solid black;" >m</th>
                <th>Tot</th>
                <th>Y/N</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finalscores->where('voicepart_id', $voicepart->id) AS $finalscore)
                <tr style="{{ $finalscore->isAccepted ? '' : 'background-color: rgba(0,0,0,.1);' }}" >
                    <td style="text-align: left;">{{ $finalscore->student->fullnameAlpha }}</td>
                    <td>{{ $finalscore->voicepartAbbr }}</td>
                    @foreach($finalscore->studentScores AS $score)
                        <td style=" @if(! ($loop->iteration % 3)) border-right: 3px solid black; @endif " >{{ $score }}</td>
                    @endforeach
                    <td>{{ (int)$finalscore->score }}</td>
                    <td>{{ $finalscore->isAccepted ? 'acc' : 'n/a' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach


