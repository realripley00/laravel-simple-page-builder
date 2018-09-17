<?php

namespace RealRipley\LaravelSimplePageBuilder;

trait Buildable
{
    /**
	 * Boot the soft taggable trait for a model.
	 *
	 * @return void
	 */
	public static function bootLaravelSimplePageBuilder()
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