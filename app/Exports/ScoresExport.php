<?php

namespace App\Exports;

use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Score;
use App\Models\Student;
use App\Models\Utilities\FinalScore;
use App\Models\Voicepart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScoresExport implements FromCollection, WithHeadings, WithMapping
{
    private $ensemble;
    private $event;
    private $scores;

    public function __construct(Event $event, Ensemble $ensemble)
    {
        $this->ensemble = $ensemble;
        $this->event = $event;
        $this->init();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->scores;
    }

    public function headings(): array
    {
        return [
            'student',
            'director',
            'voice_part',
            'j1-v-q',
            'j1-v-i',
            'j1-v-m',
            'j1-s-q',
            'j1-s-i',
            'j1-s-m',

            'j2-v-q',
            'j2-v-i',
            'j2-v-m',
            'j2-s-q',
            'j2-s-i',
            'j2-s-m',

            'j3-v-q',
            'j3-v-i',
            'j3-v-m',
            'j3-s-q',
            'j3-s-i',
            'j3-s-m',

            'total',
            'result'

        ];
    }

    public function map($row): array
    {
        $scores = $this->scoresArray($row);
        $student = Student::find($row->student_id);
        return [
            $student->fullnameAlpha,
            $student->director->fullnameAlpha,
            Voicepart::find($row->voicepart_id)->abbr,
            $scores[0],
            $scores[1],
            $scores[2],
            $scores[3],
            $scores[4],
            $scores[5],

            $scores[6],
            $scores[7],
            $scores[8],
            $scores[9],
            $scores[10],
            $scores[11],

            $scores[12],
            $scores[13],
            $scores[14],
            $scores[15],
            $scores[16],
            $scores[17],

            $row->score,
            $this->result($row),
        ];
    }

    private function init(): void
    {
        $this->scores = FinalScore::with('student')
            ->where('event_id', $this->event->id)
            ->where('ensemble_id', $this->ensemble->id)
            ->orderBy('voicepart_id')
            ->orderBy('score')
            ->get();
    }

    private function result($row): string
    {
        return $row->isAccepted ? 'acc' : 'n/a';
    }

    private function scoresArray($row): array
    {
        return $row->studentScores;
    }
}
