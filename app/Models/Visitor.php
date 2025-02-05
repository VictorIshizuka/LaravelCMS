<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';

    public $timestamps = false;
    protected $fillable = [
        'page_id',
        'ip',
        'date_access',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
