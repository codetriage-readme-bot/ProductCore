<?php

namespace RuffleLabs\ProductCore\Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use RuffleLabs\ProductCore\Facades\Catalogue;
use RuffleLabs\ProductCore\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MainTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_product_has_a_title(){
        $actualTitle = 'Test Product Title';
        $title = createAProduct(['title' => $actualTitle])->title;

        $this->assertEquals($actualTitle, $title, 'Title retrieved doesn\'t match title inputted');
    }

    /** @test */
    public function a_product_has_a_description(){
        $actualDescription = 'Test Product Description';
        $description = createAProduct(['description' => $actualDescription])->description;

        $this->assertEquals($actualDescription, $description, 'Description retrieved doesn\'t match description inputted');
    }

    /** @test */
    public function all_products_can_be_retrieved(){
        $actualAmountOfProducts = 25;
        createAProduct([], $actualAmountOfProducts);

        $amountOfProducts = Catalogue::products()->all()->count();

        $this->assertEquals($actualAmountOfProducts, $amountOfProducts, 'Did not retrieve all products that were created');
    }
    
    /** @test */
    public function a_product_is_not_published_by_default()
    {
        createAProduct();

        $productPublishedAt = Catalogue::products()->find(1)->published_at;

        $this->assertEquals(NULL, $productPublishedAt, 'Published at should be Null');
    }

    /** @test */
    public function a_product_can_be_published()
    {
        createAProduct();

        $product = Catalogue::products()->find(1);

        $this->assertEquals(NULL, $product->published_at, 'Published at should be Null');

        $product->publish();

        $this->assertTrue(!is_null($product->published_at), 'Published at should not be Null');
    }

    /** @test */
    public function a_product_can_be_unpublished()
    {
        createAProduct();

        $product = Catalogue::products()->find(1);

        $this->assertEquals(NULL, $product->published_at, 'Published at should be Null');

        $product->publish();

        $this->assertTrue(!is_null($product->published_at), 'Published at should not be Null');

        $product->publish(false);

        $this->assertEquals(NULL, $product->published_at, 'Published at should be Null');
    }

    /** @test */
    public function a_product_isPublished_should_return_false_if_not_published()
    {
        createAProduct();

        $product = Catalogue::products()->find(1);

        $this->assertEquals(false, $product->isPublished(), 'isPublished should return false');
    }

    /** @test */
    public function a_product_isPublished_should_return_true_if_published()
    {
        createAProduct(['published_at' => Carbon::now()->subDay(1)]);

        $product = Catalogue::products()->find(1);

        $this->assertEquals(true, $product->isPublished(), 'isPublished should return true');
    }


}
