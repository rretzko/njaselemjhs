<?php

namespace App\Imports;

use App\Models\Director;
use App\Models\Event;
use App\Models\Student;
use App\Models\User;
use App\Models\Voicepart;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    * array:29 [▼
    * 0 => "Sponsoring Director Name (Prefix)"
    * 1 => "Sponsoring Director Name (First)"
    * 2 => "Sponsoring Director Name (Middle)"
    * 3 => "Sponsoring Director Name (Last)"
    * 4 => "Sponsoring Director Name (Suffix)"
    * 5 => "Sponsoring Director Email"
    * 6 => "Student Name (First)"
    * 7 => "Student Name (Last)"
    * 8 => "Student Grade Level"
    * 9 => "Student Ensemble"
    * 10 => "Student Voice Part"
    * 11 => "Parent Name (First)"
    * 12 => "Parent Name (Last)"
    * 13 => "Parent Email"
    * 14 => "Parent Phone 1"
    * 15 => "Parent Phone 2"
    * 16 => "Student MP3 File"
    * 17 => "Student Contract: I certify that my student and his/her parent has read and agreed to the statement below.  In addition, I understand that as their director I a ▶"
    * ...*
    * 20 => "Entry Date"
    * ...*
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //first $row is header_row
        static $header_row = true;

        $clean = $this->cleanRow($row, $header_row);

        //early exits
        if(($header_row) || empty($clean)){

            $header_row = false;

            return null;
        }

        return new Student([
            'user_id' => $clean[0],
            'first' => $clean[6],
            'last' => $clean[7],
            'grade' => $clean[8],
            'ensemble_id' => $clean[9] ?? '',
            'voicepart_id' => $clean[10],
            'guardian_first' => $clean[11],
            'guardian_last' => $clean[12],
            'guardian_email' => $clean[13] ?? '',
            'guardian_phone1' => $clean[14] ?? '',
            'guardian_phone2' => $clean[15] ?? '',
            'mp3' => $clean[16],
            'contract' => $clean[17],
            'event_id' => $clean[20],
        ]);
    }

    private function cleanRow(array $row, bool $header_row) : array
    {
        $dup = Student::where('mp3', $row[16])->first();

        //update event_id if dup assigned to early load of event 1
        if($dup && ($dup->event_id === 1)){$dup->event_id = 2; $dup->save();}

        //return empty array if is header_row or if duplicate is found
        if($header_row || $dup){ return [];}

        $clean = $row;

        //director id (user_id)
        $director = Director::where('first', $row[1])->where('last', $row[3])->first();

        //NJACDA.com rules are that the director does not add their record until all students have been imported
        //skip students with missing director record
        if(! $director){ return [];}

        $clean[0] = $director->user_id;

        //grade
        $clean[8] = substr($row[8], 5);

        //ensemble_id
        $clean[9] = strpos($row[9],'High') ? 2 : 1;

        //voicepart_id
        $clean[10] = $this->parseVoicepart($row[10]);

        //contract
        $clean[17] = ($row[17] === 'Yes') ? 1 : 0;

        //event_id
        $clean[20] = $this->findEvent($row[20]);

        return $clean;
    }

    private function findEvent($date): int
    {
        $default = 1;

        //reformat date field 07-01-22 23:19:27 to 2022-01-07
        $entrydate = '20'.substr($date,6,2).'-'.substr($date,3,2).'-'.substr($date,0,2);

        foreach(Event::all() AS $event)
        {
            if(($entrydate >= $event->start_date) && ($entrydate <= $event->end_date)) {

                return $event->id;
            }
        }

        return $default;
    }

    private function parseVoicepart(string $str) : int
    {
        //remove domain for use as password (ex. rick@mfrholdings )
        $descr = strpos($str, 'High')
            ? substr($str,14)
            : substr($str,13);

        $voicepart = Voicepart::where('descr', $descr)->first();

        if(! $voicepart){ echo __METHOD__; dd($descr);}

        return $voicepart->id;
    }


}
