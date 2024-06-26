<?php

namespace Tests\Unit;

use App\Http\Controllers\CategoryController;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Mockery;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function test_store_category_data()
    {

        $response = $this->post(route('category.store'), [
            'name' => 'Novel'
        ]);

        // $this->assertEquals(6,Category::count());

        $response->assertRedirect(route('category.index'));

        // $category = Category::where('id',8)->first();

        // $this->assertEquals($category->name,'Novel');
    }

    public function test_update_category_data()
    {

        $category = Category::factory()->create();

        $response = $this->post(route('category.update', $category->id), [
            'name' => 'novel diary'
        ]);

        $updated_category = Category::where('id', $category->id)->first();

        $response->assertRedirect(route('category.index'));

        $this->assertNotEquals($category->name, $updated_category->name);
    }

    public function test_delete_category_data()
    {

        $category = Category::factory()->create();

        $response = $this->get(route('category.delete', $category->id));

        $response->assertRedirect(route('category.index'));
    }




    //below all test is in unit test using mockery
    public function test_store_category_data_using_mockery(): void
    {
        $categoryMock =  Mockery::mock(Category::class);

        $requestData = [
            'name' => 'Test Category',
        ];

        $mockRequest = Mockery::mock(CategoryRequest::class);
        $mockRequest->shouldReceive('all')->andReturn($requestData);

        $categoryMock->shouldReceive('create')->once()->with($requestData)->andReturn($categoryMock);

        $controller = new CategoryController($categoryMock);

        $response = $controller->store($mockRequest);
    }

    public function test_update_category_data_using_mockery()
    {
        $categoryMock =  Mockery::mock(Category::class);
        $category = Category::factory()->create();

        $requestData = [
            'name' => 'Test Category',
        ];

        $mockRequest = Mockery::mock(CategoryRequest::class);
        $mockRequest->shouldReceive('all')->andReturn($requestData);

        $categoryMock->shouldReceive('where')->once()->with('id', $category->id)->andReturnSelf();
        $categoryMock->shouldReceive('update')->once()->with($requestData)->andReturn();

        $categoryController = new CategoryController($categoryMock);
        $response = $categoryController->update($mockRequest, $category->id);
    }

    public function test_delete_category_data_using_mockery()
    {
        $categoryMock =  Mockery::mock(Category::class);

        $category = Category::factory()->create();

        $categoryMock->shouldReceive('where')->with('id', $category->id)->once()->andReturnSelf();
        $categoryMock->shouldReceive('delete')->once()->andReturn();

        $bookController = new CategoryController($categoryMock);

        $response = $bookController->delete($category->id);
    }
}
