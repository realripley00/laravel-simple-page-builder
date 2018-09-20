<?php

namespace RealRipley\Buildable\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ListItem extends Eloquent
{
    protected $table = 'listitems';
    public $timestamps = false;

    protected $fillable = [
        'text',
        'buildingblock_id'
    ];

    public function block()
    {
        return $this->belongsTo('\RealRipley\Buildable\Models\BuildingBlock', 'buildingblock_id', 'id');
    }
}