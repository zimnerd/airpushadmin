<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creative extends Model
{
    use SoftDeletes;
    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }


}
