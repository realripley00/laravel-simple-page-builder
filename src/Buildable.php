<?php

namespace RealRipley\Buildable;

use RealRipley\Buildable\Models\BuildingBlock;
use RealRipley\Buildable\Models\ListItem;

trait Buildable
{
    /**
	 * Boot the soft taggable trait for a model.
	 *
	 * @return void
	 */
	public static function bootBuildable()
	{
		// if(static::removeContentOnDelete()) {
		// 	static::deleting(function($model) {
		// 		$model->removeContent();
		// 	});
		// }
	}
	
	public function getContents()
	{
		return $this->morphMany(BuildingBlock::class, 'buildable')->orderBy('order')->get();
    }
    
    public function addHeading($heading, $order = null)
    {
		$block = new BuildingBlock();
		$block->type = 'heading';
		$block->content = $heading;
		$block->buildable_type = get_class($this);
		$block->buildable_id = $this->id;

		if ($order != null) { 
			$block->order = $order;
		}

		return $block->save();
    }
    
    public function addSubHeading($subheading, $order = null)
    {
		$block = new BuildingBlock();
		$block->type = 'subheading';
		$block->content = $subheading;
		$block->buildable_type = get_class($this);
		$block->buildable_id = $this->id;

		if ($order != null) { 
			$block->order = $order;
		}

		return $block->save();
	}
    
    public function addParagraph($paragraph, $order = null)
    {
		$block = new BuildingBlock();
		$block->type = 'paragraph';
		$block->content = $paragraph;
		$block->buildable_type = get_class($this);
		$block->buildable_id = $this->id;

		if ($order != null) { 
			$block->order = $order;
		}

		return $block->save();
	}
	
	public function addImage($url, $order = null)
    {
		$block = new BuildingBlock();
		$block->type = 'image';
		$block->content = $url;
		$block->buildable_type = get_class($this);
		$block->buildable_id = $this->id;

		if ($order != null) { 
			$block->order = $order;
		}

		return $block->save();
	}
}