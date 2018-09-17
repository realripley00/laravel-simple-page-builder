<?php

namespace RealRipley\Buildable;

trait Buildable
{
    /**
	 * Boot the soft taggable trait for a model.
	 *
	 * @return void
	 */
	public static function bootBuildable()
	{
		if(static::removeContentOnDelete()) {
			static::deleting(function($model) {
				$model->removeContent();
			});
		}
    }
    
    public function addContent()
    {
        
    }
}