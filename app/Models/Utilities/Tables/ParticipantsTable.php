<?php

namespace App\Models\Utilities\Tables;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantsTable extends Model
{
    use HasFactory;

    private $ensemble;
    private $event;
    private $tbl;

    protected $fillable = ['ensemble', 'event', 'tbl'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->ensemble = $attributes['ensemble'];
        $this->event = $attributes['event'];
        $this->tbl = '';

        $this->init();
    }

    public function table()
    {
        return $this->tbl;
    }

    private function init()
    {
        $this->tbl = $this->makeTable();
    }

    private function makeTable()
    {
        $str = $this->tableStyle();
        $str .= $this->tableInit();
        $str .= $this->tableHeaders();
        $str .= $this->tableRows();
        $str .= $this->tableFinish();

        return $str;
    }

    private function tableFinish()
    {
        return '</table>';
    }

    private function tableHeaders()
    {
        $str = '<tr>';
        $str .= '<th style="border-top:0; border-left: 0;"></th>'; //intentionally blank

        foreach($this->ensemble->voiceparts AS $voicepart){
            $str .= '<th>'.$voicepart->descr.'</th>';
        }

        $str .= '<th>Total</th>';

        $str .= '</tr>';

        return $str;
    }

    private function tableInit()
    {
        return '<table>';
    }

    private function tableRows()
    {
        $str = '<tr>';

        $str .= '<th>Participants</th>';

        foreach($this->ensemble->voiceparts AS $voicepart){

            $str .= '<td>'.Participant::where('event_id', $this->event->id)
                ->where('ensemble_id', $this->ensemble->id)
                ->where('voicepart_id', $voicepart->id)
                ->count('student_id')
                .'</td>';
        }

        $str .= '<td>'.Participant::where('event_id', $this->event->id)
                ->where('ensemble_id', $this->ensemble->id)
                ->count('student_id')
            .'</td>';

        $str .= '</tr>';

        return $str;
    }

    private function tableStyle()
    {
        $str = '<style>';

        $str .= 'table{border-collapse: collapse;margin-bottom:1rem;}td,th{border: 1px solid black;padding:0 .25rem;margin: auto;}';

        $str .= '</style>';

        return $str;
    }
}
