<style>
    .page_break{page-break-after:always;}
    table{border-collapse: collapse;}
    td,th{border: 1px solid black;}
</style>
@foreach($students AS $studentKey => $student)
        @if($student->voicepart->id !== $voicePartId) {{ $voicePartId = $student->voicepart->id }}<div class="page_break"></div> @endif
        <div id="page" class=" @if(! ($loop->iteration % 3)) page_break @endif " >

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

                <div id="table" style="margin-bottom: 55px;">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th colspan="4" style="text-align: center; border-right: 2px solid black;">VOCALISE</th>
                                <th colspan="4" style="text-align: center; border-right: 2px solid black;">SOLO</th>
                                <th style="border-top: 0; border-right: 0;"></th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;text-align: center;">Adjudicator</td>
                                <td style="font-weight: bold;text-align: center; width: 3rem;">Q</td>
                                <td style="font-weight: bold;text-align: center; width: 3rem;">I</td>
                                <td style="font-weight: bold;text-align: center; width: 3rem;">M</td>
                                <td style="font-weight: bold;text-align: center; border-right: 2px solid black; padding: 0 0.5rem; width: 3rem;">Total</td>
                                <td style="font-weight: bold;text-align: center; width: 3rem;">Q</td>
                                <td style="font-weight: bold;text-align: center; width: 3rem;">I</td>
                                <td style="font-weight: bold;text-align: center; width: 3rem;">M</td>
                                <td style="font-weight: bold;text-align: center; border-right: 2px solid black; padding: 0 0.5rem;">Total</td>
                                <td style="font-weight: bold;text-align: center; padding: 0 0.5rem;">OVERALL</td>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($student->adjudicators AS $adjudicator)

                            <tr>
                                <td>{{ $adjudicator->shortNameAlpha }}</td>

                                @forelse($adjudicator->scoreArray($student) AS $score)

                                    <td style="text-align: center; @if(! ($loop->iteration % 4)) border-right: 2px solid black; @endif "> {{ $score }} </td>
                                @empty
                                    <td colspan="7">No scores found</td>
                                @endif

                            </tr>

                        @empty
                            <tr><td colspan="10" style="padding: 0 0.5rem;">No Adjudicator Found</td> </tr>
                        @endforelse

                            <tr>
                                <td colspan="9" style="text-align: right; padding-right: 0.5rem; border-right: 2px solid black;">Total</td>
                                <td style="text-align: center;">{{ $student->scoreTotal ?: ''}}</td>
                            </tr>

                        </tbody>
                    </table>

                </div>


        </div>

@endforeach

