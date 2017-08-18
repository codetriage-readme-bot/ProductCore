<?php

namespace RuffleLabs\ProductCore\Tests\Unit;

use RuffleLabs\ProductCore\Facades\Catalogue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MainTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_product_has_a_title(){
        $actualTitle = 'Test Product Title';
        $title = getAProduct(['title' => $actualTitle])->title;

        $this->assertTrue($title == $actualTitle, 'Title retrieved doesnt match title inputted');
    }

    /** @test */
    public function a_product_has_a_description(){
        $actualDescription = 'Test Product Description';
        $description = getAProduct(['description' => $actualDescription])->description;

        $this->assertTrue($description == $actualDescription, 'Description retrieved doesn\'t match description inputted');
    }

    /** @test */
    public function all_products_can_be_retrieved(){
        $actualAmountOfProducts = 25;
        factory('RuffleLabs\ProductCore\Models\Product', $actualAmountOfProducts)->create();

        $amountOfProducts = Catalogue::products()->all()->count();

        $this->assertEquals($actualAmountOfProducts, $amountOfProducts, 'Did not retrieve all product that were created');
    }
}
