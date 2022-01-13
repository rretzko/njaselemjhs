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
                <th colspan="5">Judge 1</th>
                <th colspan="5">Judge 2</th>
                <th colspan="5">Judge 3</th>
                <th colspan="2" style="border: 0;"></th>
            </tr>
            <tr>
                <th colspan="2" style="border: 0;"></th>
                <th colspan="2">Solo</th>
                <th colspan="3">Vocalise</th>
                <th colspan="2">Solo</th>
                <th colspan="3">Vocalise</th>
                <th colspan="2">Solo</th>
                <th colspan="3">Vocalise</th>
                <th colspan="2" style="border-top: 0; border-right: 0;"></th>
            </tr>
            <tr>
                <th>Student</th>
                <th>VP</th>
                <th>VQ</th>
                <th>I</th>
                <th>VQ</th>
                <th>I</th>
                <th>M</th>
                <th>vq</th>
                <th>i</th>
                <th>vq</th>
                <th>i</th>
                <th>m</th>
                <th>VQ</th>
                <th>I</th>
                <th>VQ</th>
                <th>I</th>
                <th>M</th>
                <th>Tot</th>
                <th>Y/N</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finalscores->where('voicepart_id', $voicepart->id) AS $finalscore)
                <tr style="{{ $finalscore->isParticipant ? '' : 'background-color: rgba(0,0,0,.1);' }}" >
                    <td style="text-align: left;">{{ $finalscore->student->fullnameAlpha }}</td>
                    <td>{{ $finalscore->voicepartAbbr }}</td>
                    @foreach($finalscore->studentScores AS $score)
                        <td>{{ $score->score }}</td>
                    @endforeach
                    <td>{{ (int)$finalscore->score }}</td>
                    <td>{{ $finalscore->isParticipant ? 'acc' : 'n/a' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach


