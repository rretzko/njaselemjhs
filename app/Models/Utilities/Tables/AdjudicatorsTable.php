<?php

namespace App\Models\Utilities\Tables;

use App\Models\Ensemble;
use Illuminate\Database\Eloquent\Model;

class AdjudicatorsTable extends Model
{
    private $event;
    private $tbl;
    private $tdclass = 'px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900';
    private $thclass = 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider';

    protected $fillable = ['event'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->event = $attributes['event'];
        $this->tbl = '';
        $this->init();
    }

    public function getTableAttribute()
    {
        return $this->tbl;
    }

    private function init()
    {
        $this->tbl = '<div class="flex flex-col">';
            $this->tbl .= '<h3 class="text-lg">Event Adjudicators</h3>';
            foreach($this->event->ensembles AS $ensemble) {
                $this->tbl .= '<h4 class="mt-4">'.$ensemble->descr.' Adjudicators'.'</h4>';
                $this->tbl .= $this->beginTable();
                $this->tbl .= $this->tableHeaders();
                $this->tbl .= $this->tblBody($ensemble);
                $this->tbl .= $this->endTable();
            }
        $this->tbl .= '</div>';
    }

    private function beginTable()
    {
        return '<table class="min-w-full divide-y divide-gray-200 border border-black">';
    }

    private function endTable()
    {
        return '</table>';
    }

    private function tblBody(Ensemble $ensemble)
    {
        $cntr = 0;

        $str = '<tbody>';
        foreach ($ensemble->rooms() AS $room){

            $background = ($cntr % 2) ? 'bg-white' : 'bg-gray-50';
            $str .= '<tr class="' . $background . '">';
                $str .= '<td class="' . $this->tdclass . '">';
                    $str .= ++$cntr;
                $str .= '</td>';
                $str .= '<td class="' . $this->tdclass . '">';
                    $str .= $room->name;
                $str .= '</td>';
                $str .= '<td class="' . $this->tdclass . '">';
                    foreach ($room->adjudicators as $adjudicator){
                        $str .= $adjudicator->director->fullnameAlpha.'<br />';
                    }
                $str .= '</td>';
                $str .= '<td class="' . $this->tdclass . '">';
                    $str .= '<a href="/administration/adjudicators/edit/'.$this->event->id.'/'.$ensemble->id.'/'.$room->id.'">';
                        $str .= '<button class="bg-indigo-50 border rounded px-2">';
                            $str .= 'Edit';
                        $str .= '</button>';
                    $str .= '</a>';
                $str .= '</td>';
            $str .= '</tr>';

        }

        $str .= '</tbody>';

        return $str;
    }

    private function tableHeaders()
    {
        $str = '<thead class="bg-gray-50">';
        $str .= '<tr>';
        $str .= '<th scope="col" class="'.$this->thclass.'">###</th>';
        $str .= '<th scope="col" class="'.$this->thclass.'">Room</th>';
        $str .= '<th scope="col" class="'.$this->thclass.'">Name</th>';
        $str .= '<th scope="col" class="'.$this->thclass.' sr-only">Edit</th>';
        $str .= '</tr>';
        $str .= '</thead>';

        return $str;
    }
}
