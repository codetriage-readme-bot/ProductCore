<?php

namespace RuffleLabs\ProductCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use RuffleLabs\ProductCore\Models\Contracts\CatalogueItemInterface;

class CatalogueItemBase extends Model implements CatalogueItemInterface
{
    protected $table;

    public function setup(){
        $this->setTableName();
    }

    public function setTableName(){
        dd(config('catalogue.table_name'));
        if(!isset(config('catalogue.table_name')) || empty(config('catalogue.table_name')){
            App::abort(404, 'Catalogue Table name cannot be found');
        }

    }
}
