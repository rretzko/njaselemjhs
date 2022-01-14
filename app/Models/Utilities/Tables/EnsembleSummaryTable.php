<?php

namespace App\Models\Utilities\Tables;

use App\Models\Participant;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnsembleSummaryTable extends Model
{
    use HasFactory;

    private $ensemble;
    private $event;
    private $tbl;

    protected $fillable = ['event', 'tbl'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->ensemble = null;
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
        foreach($this->event->ensembles AS $ensemble){

            $this->ensemble = $ensemble;

            $this->tbl .= '<div class="bg-white p-2">';
            $this->tbl .= $this->makeTable();
            $this->tbl .= '</div>';
        }

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
        $str .= '<th>'.$this->ensemble->name.'</th>';

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

        $str .= '<th>Registrants</th>';

        foreach($this->ensemble->voiceparts AS $voicepart){

            $str .= '<td class="text-center">'.Student::where('event_id', $this->event->id)
                ->where('ensemble_id', $this->ensemble->id)
                ->where('voicepart_id', $voicepart->id)
                ->count('id')
                .'</td>';
        }

        $str .= '<td class="text-center">'.Student::where('event_id', $this->event->id)
                ->where('ensemble_id', $this->ensemble->id)
                ->count('id')
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
