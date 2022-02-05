<?php

namespace App\Api\Book\Http;

use App\Api\Book\Repositories\PaperBookRepository;
use App\Api\Book\Services\BookService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    private $bookService;

    public function __construct()
    {
        $this->bookService = new BookService(new PaperBookRepository());
    }

    public function getBooks()
    {
       return $this->bookService->books();
    }

    public function getBook(int $id)
    {
       return $this->bookService->book($id);
    }

    public function addBook(Request $request)
    {
        return $this->bookService->createBook($request->all());
    }

    public function updateBook(Request $request,int $id)
    {
        return $this->bookService->updateBook($id,$request->all());
    }

    public function deleteBook(int $id)
    {
      return $this->bookService->deleteBook($id);
    }
}
