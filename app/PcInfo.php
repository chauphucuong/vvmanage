<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PcInfo extends Model
{
    protected $table="pcinfo";
    protected $primarykey="id";
    
    public function scopeBlacklist($query)
    {
        // dd($query);
        $blacklist = BlackList::all();
        // dd($blacklist->toArray()[0]['Softwarename']);
        foreach($blacklist as $list) {
            $array_black_list[] = $list->Softwarename; 
        }
        // dd($array_black_list);
        return $query->whereNotIn('Softwarename', $array_black_list)->distinct()->get(["Softwarename"]);
    }
    // ->join('contacts', 'users.id', '=', 'contacts.user_id')
    // >whereNotIn('id', [1, 2, 3])
}
