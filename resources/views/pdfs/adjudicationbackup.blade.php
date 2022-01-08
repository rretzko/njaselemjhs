<style>
    .page_break{page-break-after:always;}
    table{border-collapse: collapse;}
    td,th{border: 1px solid black;}
</style>
@foreach($students AS $student)
    <div id="page" class="page_break">
    @for($i=0; $i<3;$i++)
            <header style="font-size: 1.5rem; margin-bottom: 1rem;">
                <div >
                    <b>{{ $student->fullnameAlpha }}</b>
                </div>
                <div>
                    Grade: <b>{{ $student->grade }}</b>
                </div>
                <div>
                    Ensemble: <b>{{ $student->ensembleName }} - {{ $student->voicepartDescr }}</b>
                </div>
            </header>
            <div id="table" style="margin-bottom: 110px;">
                <table>
                    <thead>
                        <tr>
                            <th colspan="3" style="text-align: center;">VOCALISE</th>
                            <th colspan="4" style="text-align: center;">SOLO</th>
                            <th style="border-top: 0; border-right: 0;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: bold;text-align: center;">Vocal Quality</td>
                            <td style="font-weight: bold;text-align: center;">Intonation</td>
                            <td style="font-weight: bold;text-align: center;">Total Vocalise</td>
                            <td style="font-weight: bold;text-align: center;">Vocal Quality</td>
                            <td style="font-weight: bold;text-align: center;">Intonation</td>
                            <td style="font-weight: bold;text-align: center;">Musicianship</td>
                            <td style="font-weight: bold;text-align: center;">Total Solo</td>
                            <td style="font-weight: bold;text-align: center;">OVERALL TOTAL</td>
                        </tr>
                        <tr>
                            <td style="height: 40px;"></td>
                            <td style=""></td>
                            <td style=""></td>
                            <td style=""></td>
                            <td style=""></td>
                            <td style=""></td>
                            <td style=""></td>
                            <td style=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    @endfor
    </div>

@endforeach
