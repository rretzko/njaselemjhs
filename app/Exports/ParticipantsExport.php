<?php

namespace App\Exports;

use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping
{
    private $participants;

    public function __construct(Event $event, Ensemble $ensemble)
    {
        $this->participants = Participant::where('event_id', $event->id)
            ->where('ensemble_id', $ensemble->id)
            ->get()
            ->sortBy(['voicepart_id', 'student.last']);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->participants;
    }

    public function headings(): array
    {
        return [
            'id',
            'student_id',
            'last',
            'first',
            'voice part',
            'grade',
            'score',
            'school',
            'director_first',
            'director_last',
            'director_email',
            'director_phone',
            'parent_first',
            'parent_last',
            'parent_email',
            'parent_phone1',
            'parent_phone_s',
        ];
    }

    public function map($participant): array
    {
        return [
            $participant->id,
            $participant->student_id,
            $participant->student->last,
            $participant->student->first,
            $participant->voicepart->descr,
            $participant->student->grade,
            (int)$participant->finalScore,
            $participant->student->schoolName,
            $participant->student->director->first,
            $participant->student->director->last,
            $participant->student->director->user->email,
            $participant->student->director->phone,
            $participant->student->guardian_first,
            $participant->student->guardian_last,
            $participant->student->guardian_email,
            $participant->student->guardian_phone1,
            $participant->student->guardian_phone2,
        ];
    }
}
