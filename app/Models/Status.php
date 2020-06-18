<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    public $timestamps = FALSE;

    /**
     * Get the notes for the status.
     */
    public function notes()
    {
        return $this->hasMany('App\Models\Notes');
    }

    /**
     * Get the notes for the status.
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function creatives()
    {
        return $this->hasMany(Creative::class);
    }
}
