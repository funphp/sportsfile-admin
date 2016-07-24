<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $table = 'groups_tbl';
    protected $primaryKey = 'group_id';
    public $timestamps = false;

    public static function getAllWithUserGroup($user_groups) {
        $group = self::all();
        foreach($group as $key=>$g) {
            if(in_array($g->group_id, $user_groups)) {
                $group[$key]->selected = true;
            } else {
                $group[$key]->selected = false;
            }
        }
        return $group;
    }

    public static function getAllSFPermissionWtihUser($sfUsers) {
        $sfPermission = [
            ['name'=>'Download', 'value'=>'Download'],
            ['name'=>'Order', 'value'=>'Order'],
            ['name'=>'Edit', 'value'=>'Edit'],
            ['name'=>'FULLDIARY', 'value'=>'FULLDIARY'],
            ['name'=>'SHORTDIARY', 'value'=>'SHORTDIARY']
        ];
        foreach($sfPermission as $key=>$g) {
            if(in_array($g['value'], $sfUsers)) {
                $sfPermission[$key]['selected'] = true;
            } else {
                $sfPermission[$key]['selected'] = false;
            }
        }
        return $sfPermission;

    }

    public static function getAllPRPermissionWtihUser($prUsers) {
        $prPermission = [
            ['name'=>'Download', 'value'=>'Download'],
            ['name'=>'Order', 'value'=>'Order'],
            ['name'=>'Edit', 'value'=>'Edit']
        ];
        foreach($prPermission as $key=>$g) {
            if(in_array($g['value'], $prUsers)) {
                $prPermission[$key]['selected'] = true;
            } else {
                $prPermission[$key]['selected'] = false;
            }
        }
        return $prPermission;

    }

}
