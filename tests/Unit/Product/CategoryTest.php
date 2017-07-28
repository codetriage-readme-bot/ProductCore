<?php

namespace RuffleLabs\ProductCore\Tests\Unit;

use Illuminate\Support\Collection;
use RuffleLabs\ProductCore\Facades\Catalogue;
use RuffleLabs\ProductCore\Models\ProductCategory;
use RuffleLabs\ProductCore\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_product_does_not_have_a_category_by_default()
    {
        $product = createAProduct();

        $this->assertEquals(null, $product->categories->first(), 'A product should not have a category by default');
    }

    /** @test */
    public function a_product_can_have_a_category()
    {
        $product = createAProduct();

        $categoryName = 'Toys';
        $product->assignCategory(createACategory(['name' => $categoryName]));

        $product = Catalogue::products()->all()->first();

        $this->assertInstanceOf(\RuffleLabs\ProductCore\Models\ProductCategory::class, $product->categories->first());
        $this->assertEquals($categoryName, $product->categories->first()->name, 'A product should have a category');
    }

    /** @test */
    public function a_product_can_have_multiple_categories()
    {
        $product = createAProduct();

        $product->assignCategory(createACategory());
        $product->assignCategory(createACategory());

        $product = Catalogue::products()->all()->first();

        $this->assertInstanceOf(\RuffleLabs\ProductCore\Models\ProductCategory::class, $product->categories->first());
        $this->assertEquals(2, $product->categories->count());
    }

    /** @test */
    public function a_product_cannot_be_published_without_a_category()
    {
        $this->expectException(HttpException::class);

        $product = createAProduct();
        $product->publish();
    }

    /** @test */
    public function a_product_can_have_a_sub_category()
    {
        $product = createAProduct();

        $topLevelCategory = createACategory();
        $product->assignCategory($topLevelCategory);
        $product->assignCategory(createASubCategory(1));

        $topLevelCategory = $product->categories()->first();

        $subCategories = $topLevelCategory->children();

        $this->assertInstanceOf(\RuffleLabs\ProductCore\Models\ProductCategory::class, $subCategories->first());
        $this->assertEquals(2, $subCategories->first()->id, 'Sub Category ID should be 2');
        $this->assertEquals(1, $subCategories->first()->parent_id, 'Sub Category Parent ID should be 1');
    }

    /** @test */
    public function a_category_can_have_children()
    {
        $topLevelCategory = createACategory();
        createASubCategory(1);

        $topLevelCategory = ProductCategory::find($topLevelCategory->id);
        $subCategories = $topLevelCategory->children();

        $this->assertInstanceOf(\RuffleLabs\ProductCore\Models\ProductCategory::class, $subCategories->first());
        $this->assertEquals(2, $subCategories->first()->id, 'Sub Category ID should be 2');
        $this->assertEquals(1, $subCategories->first()->parent_id, 'Sub Category Parent ID should be 1');
    }

    /** @test */
    public function a_sub_category_can_have_only_one_parent()
    {
        $topLevelCategory = createACategory();
        $subCategory = createASubCategory(1);

        $subCategory = ProductCategory::find($subCategory->id);
        $topLevelCategory = $subCategory->parent();

        $this->assertInstanceOf(\RuffleLabs\ProductCore\Models\ProductCategory::class, $topLevelCategory);
    }

    /** @test */
    public function a_product_retrieving_categories_should_not_retrieve_sub_categories()
    {
        $product = createAProduct();

        $topLevelCategory = createACategory();
        $product->assignCategory($topLevelCategory);
        $product->assignCategory(createASubCategory(1));

        $categories = $product->categories;

        foreach ($categories as $category)
        {
            $this->assertEquals(NULL, $category->pluck('parent_id'), 'Categories should only return categories without a parentId');
        }
    }
}
