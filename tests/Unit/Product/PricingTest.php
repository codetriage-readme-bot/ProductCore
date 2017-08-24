<?php

namespace RuffleLabs\ProductCore\Tests\Unit;

use RuffleLabs\ProductCore\Facades\Catalogue;
use RuffleLabs\ProductCore\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PricingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_product_will_have_a_price()
    {
        $price = createAProduct()->price;

        $this->assertInternalType('string', $price, 'Price is not a string, assumed no price');
    }

    /** @test */
    public function a_products_price_will_be_in_the_correct_price_format()
    {
        $price = createAProduct()->price;

        $amountOfDecimalPlaces = strlen(str_after($price, '.'));

        $this->assertEquals(2, $amountOfDecimalPlaces, 'Price does not have 2 decimal places');
        $this->assertContains('£', $price, 'Price does not contain a £');
    }

    /** @test */
    public function a_products_price_can_be_updated(){
        $newPrice = '5.00';
        $product = createAProduct();

        $product->price = $newPrice;

        $price = Catalogue::products()->first()->price;

        $this->assertEquals($newPrice, str_after($price, '£'), 'Price retrieved does not match price inputted');
    }
}
