<?php

namespace RealRipley\Buildable;

use RealRipley\Buildable\Models\BuildingBlock;
use RealRipley\Buildable\Models\ListItem;

trait Buildable
{
    /**
	 * Boot the buildable trait.
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
		return $this->morphMany(
			BuildingBlock::class, 'buildable'
		)->orderBy('order')->get()->map(function($block) {
			if ($block->type == 'orderedlist' || $block->type == 'numberedlist' || $block->type == 'alphalist') {
				$block->listItems = $block->items;
			}
			return $block;
		});
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

	public function addOrderedList($firstListItem, $order = null)
    {
		$block = new BuildingBlock();
		$block->type = 'orderedlist';
		$block->content = $firstListItem;
		$block->buildable_type = get_class($this);
		$block->buildable_id = $this->id;

		if ($order != null) { 
			$block->order = $order;
		}

		$list = $block->save();
		
		$listItem = new ListItem();
		$listItem->text = $firstListItem;
		$listItem->buildingblock_id = $block->id;

		$listItem->save();

		return $listItem;
		
	}

	public function addNumberedList($firstListItem, $order = null)
    {
		$block = new BuildingBlock();
		$block->type = 'numberedlist';
		$block->content = $firstListItem;
		$block->buildable_type = get_class($this);
		$block->buildable_id = $this->id;

		if ($order != null) { 
			$block->order = $order;
		}

		$list = $block->save();
		
		$listItem = new ListItem();
		$listItem->text = $firstListItem;
		$listItem->buildingblock_id = $block->id;

		$listItem->save();

		return $listItem;
		
    }
    
    public function addAlphaList($firstListItem, $order = null)
    {
		$block = new BuildingBlock();
		$block->type = 'alphalist';
		$block->content = $firstListItem;
		$block->buildable_type = get_class($this);
		$block->buildable_id = $this->id;

		if ($order != null) { 
			$block->order = $order;
		}

		$list = $block->save();
		
		$listItem = new ListItem();
		$listItem->text = $firstListItem;
		$listItem->buildingblock_id = $block->id;

		$listItem->save();

		return $listItem;
		
	}

	public function getList($list_id)
	{
		$block = ListItem::find($list_id)->block;

		return $block;
	}

	public function addListItem($list_id, $text)
	{
		$listItem = new ListItem();
		$listItem->text = $text;
		$listItem->buildingblock_id = $list_id;

		$listItem->save();

		return $listItem;
    }
    
    public function removeContent($block_id)
	{
		$block = BuildingBlock::find($block_id);

		if ($block) {

			if ($block->type == 'orderedlist' || $block->type == 'numberedlist') {
				foreach($block->items as $item) {
					ListItem::destroy($item->id);
				}
			}

			BuildingBlock::destroy($block->id);

			return true;
		}

		return false;
    }
    
    public function updateContent($block_id, $content)
	{
		$block = BuildingBlock::find($block_id);

		if ($block) {
			$block->content = $content;
			$block->save();

			return true;
		}

		return false;
	}
}