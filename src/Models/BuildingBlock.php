<?php

namespace RealRipley\Buildable\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingBlock extends Eloquent
{
    protected $table = 'buildingblocks';
    public $timestamps = true;
    
    protected $fillable = [
        'type',
        'buildable_type',
        'buildable_id',
        'content',
        'order'
    ];

    public function buildable()
    {
        return $this->morphTo();
    }

    public function items()
    {
        return $this->hasMany('\RealRipley\Buildable\Models\ListItem');
    }
}