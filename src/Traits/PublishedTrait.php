<?php

namespace RuffleLabs\ProductCore\Traits;

use Carbon\Carbon;

trait PublishedTrait
{
    /**
     * @param $publish Boolean
     * @return $this
     */
    public function publish($publish = true)
    {
        if ($this->isPublished() && $publish) {
            return $this->published_at;
        }

        if (!$publish) {
            $this->published_at = null;
        } elseif ($publish || is_null($publish)) {
            $this->published_at = Carbon::now()->toDateTimeString();
        }

        return $this->published_at;
    }

    /**
     * Is the product currently published
     * @return bool
     */
    public function isPublished()
    {
        if (is_null($this->published_at)) {
            return false;
        }

        $publishedDate = new Carbon($this->published_at);
        if ($publishedDate->lte(Carbon::now())) {
            return true;
        } else {
            return false;
        }
    }
}
