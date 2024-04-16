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

    public function test_store_category_data(){
        $response = $this->post(route('category.store'),[
            'name' => 'Novel'
        ]);

        $this->assertEquals(6,Category::count());

        $response->assertRedirect(route('category.index'));

        $category = Category::where('id',8)->first();

        $this->assertEquals($category->name,'Novel');
    }

    public function test_update_category_data(){

        $category = Category::where('id',8)->first();

        $response = $this->post(route('category.update',$category->id),[
            'name' => 'Mystrey'
        ]);

        $updated_category = Category::where('id',8)->first();

        $response->assertRedirect(route('category.index'));

        $this->assertEquals('Mystrey',$updated_category->name);
    }

    public function test_delete_category_data(){

        $category = Category::where('id',4)->first();

        $response = $this->get(route('category.delete',$category->id));

        $response->assertRedirect(route('category.index'));
    }




    //below all test is in unit test using mockery
    public function testStoreCategory(): void
    {
        $categoryMock =  Mockery::mock(Category::class);
        $category = Category::factory()->create();

        $request = new CategoryRequest([
            'name' => $category->name,
        ]);

        $categoryMock->shouldReceive('create')->once()->andReturn();

        $categoryController = new CategoryController($categoryMock);
        $response = $categoryController->store($request);
    }

    public function testUpdateCategory()
    {
        $categoryMock =  Mockery::mock(Category::class);
        $category = Category::factory()->create();

        $newName = "New Name";

        $request = new CategoryRequest([
            'name' => $newName,
        ]);

        $categoryMock->shouldReceive('where')->with('id', $category->id)->once()->andReturnSelf();
        $categoryMock->shouldReceive('update')->once()->andReturn();

        $categoryController = new CategoryController($categoryMock);
        $response = $categoryController->update($request, $category->id);
    }

    public function testDeleteCategory()
    {
        $categoryMock =  Mockery::mock(Category::class);

        $category = Category::factory()->create();

        $categoryMock->shouldReceive('where')->with('id',$category->id)->once()->andReturnSelf();
        $categoryMock->shouldReceive('delete')->once()->andReturn();

        $bookController = new CategoryController($categoryMock);

        $response = $bookController->delete($category->id);
    }
}
