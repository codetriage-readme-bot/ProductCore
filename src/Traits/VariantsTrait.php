<?php

namespace RuffleLabs\ProductCore\Traits;

use Illuminate\Support\Facades\DB;

trait VariantsTrait
{
    public function getVariants($id, $columns = ['*'])
    {
        DB::where($this->item->id);
    }
}
