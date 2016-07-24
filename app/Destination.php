<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //

    protected $table = 'dest_outbox_tbl';
    public $timestamps = false;


    public static function getAllWithUserDestination($user_dest) {
        $destination = self::all();
        foreach($destination as $key=>$g) {
            if(in_array($g->id, $user_dest)) {
                $destination[$key]->selected = true;
            } else {
                $destination[$key]->selected = false;
            }
        }
        return $destination;
    }
}
