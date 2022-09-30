<?php

namespace App\Exports;

use App\Models\Director;
use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DirectorsExport implements FromCollection, WithHeadings, WithMapping
{
    private $directors;

    public function __construct($directors)
    {
        $this->directors = $directors;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->directors;
    }

    public function headings(): array
    {
        return [
            'user_id',
            'last',
            'first',
            'email',
            'address1',
            'address2',
            'city',
            'state_abbr',
            'postal_code',
            'phone',
            'school',
            'saddress1',
            'saddress2',
            'scity',
            'sstate_abbr',
            'spostal_code',
            'judging_day',
            'rehearsal_day',
            'jfestival_day',
            'elem_student_count',
            'jsh_student_count',
        ];
    }

    public function map($director): array
    {
        return [
            $director->user_id,
            $director->last,
            $director->first,
            $director['user']->email,
            $director->address1,
            $director->address2,
            $director->city,
            $director->state_abbr,
            $director->postal_code,
            $director->phone,
            $director->school,
            $director->saddress,
            $director->saddress2,
            $director->scity,
            $director->sstate_abbr,
            $director->spostal_code,
            $director->judging_day,
            $director->rehearsal_day,
            $director->jfestival_day,
            $director->elem_student_count,
            $director->jsh_student_count,
        ];
    }
}
