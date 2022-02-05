<?php
namespace App\Api\Book\Services;

use App\Api\Book\Validation\Validation;
use App\Api\Book\Interfaces\{BookRepositoryInterface,BookServiceInterface};
use App\Api\Book\Resources\{BookCollection,BookResource};
use Illuminate\Foundation\Http\FormRequest;
use App\Api\Book\Traits\JsonResponse;
use Illuminate\Support\Facades\Log;

class BookService implements BookServiceInterface
{
   use JsonResponse;

   private $bookRepository;
   private $rules;

   public function __construct(BookRepositoryInterface $bookRepository,FormRequest $rules)
   {
      $this->bookRepository = $bookRepository;
      $this->rules = $rules;
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
      $validate = Validation::fields($data,$this->rules->rules());
      if(is_array($validate)){
         return JsonResponse::responseErrors($validate);
      }
      $book = $this->bookRepository->createItem($data);
      return new BookResource($book);
   }

   public function updateBook(int $id, array $data)
   {
      if(empty($data)){
        return JsonResponse::badRequest();
      }
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
