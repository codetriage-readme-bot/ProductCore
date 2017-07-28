<?php

namespace RuffleLabs\ProductCore\Traits;

use Spatie\MediaLibrary\Media;

trait ImageConversions
{
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('small')
            ->width(300)
            ->height(300)
            ->optimize();

        $this->addMediaConversion('medium')
            ->width(600)
            ->height(600)
            ->optimize();

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(1200)
            ->optimize();
    }
}
