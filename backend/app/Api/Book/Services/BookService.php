<?php
namespace App\Api\Book\Services;

use App\Api\Book\Response\JsonResponse;
use App\Api\Book\Interfaces\{BookRepositoryInterface,BookServiceInterface};
use App\Api\Book\Resources\{BookCollection,BookResource};

class BookService implements BookServiceInterface
{
   private $bookRepository;

   public function __construct(BookRepositoryInterface $bookRepository)
   {
      $this->bookRepository = $bookRepository;
   }

   public function books(?int $per_page=15)
   {
       $books = $this->bookRepository->getItems($per_page);
       return new BookCollection($books);
   }

   public function book(int $id)
   {
       $book = $this->bookRepository->getItem($id);
       if(!$book){
           return JsonResponse::responseApi('NOT_FOUND',404);
       }
       return new BookResource($book);
   }

   public function createBook(array $data)
   {
      $book = $this->bookRepository->createItem($data);
      return new BookResource($book);
   }

   public function updateBook(int $id, array $data)
   {
      $is_updated = $this->bookRepository->updateItem($id,$data);
      if(!$is_updated){
          return JsonResponse::responseApi('NOT_FOUND',404);
      }
      $book = $this->book($id);
      return new BookResource($book);
   }

   public function deleteBook(int $id)
   {
      $is_deleted = $this->bookRepository->deleteItem($id);
      if(!$is_deleted){
          return JsonResponse::responseApi('NOT_FOUND',404);
      }
      return JsonResponse::responseApi('DELETED',200);
   }
}
