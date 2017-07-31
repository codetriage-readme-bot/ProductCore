<?php

namespace RuffleLabs\ProductCore\Traits;

trait PublishedTrait
{
    /**
     * @param $publish Boolean
     * @return $this
     */
    public function setPublishedDate(boolean $publish)
    {
        if(!$publish){
            $this->published_at = null;
        }

        if($publish && is_null($this->published_at)){
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
        if(is_null($this->item->published_at)){
            return false;
        }

        $publishedDate = new Carbon($this->item->published_at);
        if($publishedDate->gte(Carbon::now())){
            return true;
        }
        else{
            return false;
        }
    }
}
