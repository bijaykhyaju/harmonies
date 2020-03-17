<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public function complete(){
      $this->completed_at = "2019-12-30 09:05:10";
      $this->save();
      
    }
}
