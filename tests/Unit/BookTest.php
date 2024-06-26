<?php

namespace Tests\Unit;

use App\Http\Controllers\BookContrller;
use App\Http\Requests\Book\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Mockery;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function test_store_book_data()
    {
        $response = $this->post(route('book.store'), [
            'name' => "The Adventures of Huckleberry Finn",
            'description' => "Book description",
            'category_id' => 8,
            'author' => "Mark Twain",
            'price' => 529,
        ]);

        // $this->assertEquals(5, Book::count());

        $response->assertRedirect(route('book.index'));

        // $book = Book::where('id', 8)->first();

        // $this->assertEquals($book->name, 'The Adventures of Huckleberry Finn');
    }


    public function test_update_book_data(){

        $book = Book::factory()->create();

        $response = $this->post(route('book.update',$book->id),[
            'name' => "The Adventures of Huckleberry Finn",
            'description' => "Book description",
            'category_id' => 5,
            'author' => "Mark Twain",
            'price' => 529,
        ]);

        $updated_book = Book::where('id',$book->id)->first();

        $response->assertRedirect(route('book.index'));

        $this->assertNotEquals($book->name,$updated_book->name);
    }

    public function test_delete_book_data(){

        $book = Book::factory()->create();

        $response = $this->get(route('book.delete',$book->id));

        $response->assertRedirect(route('book.index'));
    }




    //below all test is in unit test using mockery
    public function test_store_book_data_using_mockery(): void
    {
        $bookMock = Mockery::mock(Book::class);

        $requestData = [
            'name' => "The Adventures of Huckleberry Finn",
            'description' => "Book description",
            'category_id' => "5",
            'author' => "Mark Twain",
            'price' => "529",
        ];

        $mockRequest = Mockery::mock(BookRequest::class);
        $mockRequest->shouldReceive('all')->andReturn($requestData);

        $bookMock->shouldReceive('create')->once()->with($requestData)->andReturn($bookMock);

        $bookControlller = new BookContrller($bookMock);

        $response = $bookControlller->store($mockRequest);
    }

    public function test_update_book_data_using_mockery()
    {
        $bookMock = Mockery::mock(Book::class);

        $book = Book::factory()->create();

        $requestData = [
            'name' => "The Adventures of Huckleberry Finn",
            'description' => "Book description",
            'category_id' => "5",
            'author' => "Mark Twain",
            'price' => "529",
        ];

        $mockRequest = Mockery::mock(BookRequest::class);
        $mockRequest->shouldReceive('all')->andReturn($requestData);

        $bookMock->shouldReceive('where')->with('id', $book->id)->once()->andReturnSelf();
        $bookMock->shouldReceive('update')->once()->with($requestData)->andReturn($bookMock);

        $bookControlller = new BookContrller($bookMock);
        $response = $bookControlller->update($mockRequest, $book->id);
    }

    public function test_delete_book_data_using_mockery()
    {
        $bookMock = Mockery::mock(Book::class);

        $book = Book::factory()->create();

        $bookMock->shouldReceive('where')->with('id', $book->id)->once()->andReturnSelf();
        $bookMock->shouldReceive('delete')->once()->andReturn();

        $bookControlller = new BookContrller($bookMock);
        $response = $bookControlller->delete($book->id);
    }
}
