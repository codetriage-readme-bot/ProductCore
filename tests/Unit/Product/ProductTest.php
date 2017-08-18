<?php

namespace RuffleLabs\ProductCore\Tests\Unit;

use RuffleLabs\ProductCore\Facades\Catalogue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ServerResponseTest extends TestCase
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
    public function a_product_will_have_a_price()
    {
        $price = getAProduct()->price;

        $this->assertInternalType('string', $price, 'Price is not a string, assumed no price');
    }

    /** @test */
    public function a_products_price_will_be_in_the_correct_price_format()
    {
        $price = getAProduct()->price;

        $amountOfDecimalPlaces = strlen(str_after($price, '.'));

        $this->assertEquals(2, $amountOfDecimalPlaces, 'Price does not have 2 decimal places');
        $this->assertContains('£', $price, 'Price does not contain a £');
    }
    
    /** @test */
    public function a_products_price_can_be_updated(){
        $newPrice = '5.00';
        $product = getAProduct();

        $product->price = $newPrice;

        $price = Catalogue::products()->first()->price;

        $this->assertEquals($newPrice, str_after($price, '£'), 'Price retrieved does not match price inputted');
    }

    /** @test */
    public function all_products_can_be_retrieved(){
        $actualAmountOfProducts = 25;
        factory('RuffleLabs\ProductCore\Models\Product', $actualAmountOfProducts)->create();

        $amountOfProducts = Catalogue::products()->all()->count();

        $this->assertEquals($actualAmountOfProducts, $amountOfProducts, 'Did not retrieve all product that were created');
    }
}
