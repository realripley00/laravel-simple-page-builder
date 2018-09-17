<?php

namespace RealRipley\LaravelSimplePageBuilder\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ListItem extends Eloquent
{
    protected $table = 'listitems';
    protected $timestamps = true;

    protected $fillable = [
        'text',
        'buildingblock_id'
    ];

    public function blocks()
    {
        return $this->belongsTo('\RealRipley\Models\BuildingBlock');
    }
}