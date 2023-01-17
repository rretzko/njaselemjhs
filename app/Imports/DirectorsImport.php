<?php

namespace App\Imports;

use App\Models\Director;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class DirectorsImport implements ToModel
{
    /**
    * @param array $row
    * array:39 [▼
    * 0 => "Name (First)"
    * 1 => "Name (Last)"
    * 2 => "Home Address (Street Address)"
    * 3 => "Home Address (Address Line 2)"
    * 4 => "Home Address (City)"
    * 5 => "Home Address (State / Province)"
    * 6 => "Home Address (ZIP / Postal Code)"
    * 7 => "Home Address (Country)"
    * 8 => "Email"
    * 9 => "Phone"
    * 10 => "I am a CURRENT member of:"
    * 11 => "Membership Card"
    * 12 => "Name of School/Organization"
    * 13 => "School Address (Street Address)"
    * 14 => "School Address (Address Line 2)"
    * 15 => "School Address (City)"
    * 16 => "School Address (State / Province)"
    * 17 => "School Address (ZIP / Postal Code)"
    * 18 => "School Address (Country)"
    * 19 => "Judging Day - Saturday, January 22"
    * 20 => "Rehearsal Day - Saturday, April 30"
    * 21 => "Festival Day - Saturday, May 7"
    * 22 => "How many students have you submitted for the Elementary Honor Choir audition?"
    * 23 => "How many students have you submitted for the Junior High School Honor Choir audition?"
    * ...
     *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //first $row is header_row
        static $header_row = true;

        //get current event
        static $currentEventId = 0;
        if(! $currentEventId){

            $currentEventId = Event::currentEvent()->first()->id;
        }

        $clean = $this->cleanRow($row, $header_row, $currentEventId);

        //early exits
        if(($header_row) || empty($clean)){

            $header_row = false;

            return null;
        }

        //ensure email address before continuing
        if(strlen($clean[8])) {
            $user = $this->createUser($clean);

            //add $user->id to $this->userIds
            DB::table('director_event')->insert(['user_id' => $user->id, 'event_id' => $currentEventId]);

            return new Director([
                'user_id' => $user->id,
                'first' => $clean[0],
                'last' => $clean[1],
                'address1' => $clean[2],
                'address2' => $clean[3] ?? '',
                'city' => $clean[4],
                'state_abbr' => $clean[5] ?? 'NJ',
                'postal_code' => $clean[6],
                'country' => $clean[7] ?? 'US',
                //'email' => $clean[8], Email is in the users table
                'phone' => $clean[9],
                'membership' => $clean[10],
                'membership_card' => $clean[11],
                'school' => $clean[12],
                'saddress1' => $clean[13],
                'saddress2' => $clean[14] ?? '',
                'scity' => $clean[15],
                'sstate_abbr' => $clean[16] ?? 'NJ',
                'spostal_code' => $clean[17],
                'judging_day' => strlen($clean[19]) ? 1 : 0,
                'rehearsal_day' => strlen($clean[20]) ? 1 : 0,
                'festival_day' => strlen($clean[21]) ? 1 : 0,
                'elem_student_count' => $clean[22] ?? 0,
                'jhs_student_count' => ($clean[23] === 'N/A') ? 0 : ($clean[23] === '' ? 0 : $clean[23]),
            ]);
        }
    }

    private function cleanRow(array $row, bool $header_row,int $currentEventId=0) : array
    {
        $dup = User::where('email', $row[8])->first();

        //if $dup, add user_id to $user_ids
        if($dup && $dup->id){
            DB::table('director_event')->insert(['user_id' => $dup->id, 'event_id' => $currentEventId]);
        }

        //return empty array if is header_row or if duplicate is found
        if($header_row || $dup){ return [];}

        $clean = $row;

        //postal code
        if(strlen($row[6]) === 4){ $clean[6] = '0'.$row[6]; }

        return $clean;
    }

    private function createUser(array $clean)
    {
        //remove domain for use as password (ex. rick@mfrholdings )
        $password = substr($clean[8],0,strpos($clean[8],'.'));

        return User::create([
           'name' => $clean[0].' '.$clean[1],
           'email' => $clean[8],
           'password' => Hash::make($password),
        ]);
    }
}
