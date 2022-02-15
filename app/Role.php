<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable =[
      'role',
    ];

    public function users(){
      return $this->belongsToMany(User::class);
    }

    public function showUsers(){
      if(count($this->users) > 0):
       foreach($this->users as $user)
        echo $user->formattedName().'<br>';
     endif ;
    }
}
