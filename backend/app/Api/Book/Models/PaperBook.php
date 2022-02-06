<?php

namespace App\Api\Book\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperBook extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'published',
        'book_category',
        'price'
    ];

    /**
     * list books
     * @return PaperBook[]|\Illuminate\Database\Eloquent\Collection
     */
    public function books($per_page){
        return PaperBook::where('book_category','=','paper')->orderBy('id','desc')->paginate($per_page);
    }

    /**
     * single book
     * @param int $id
     * @return mixed
     */
    public function bookItem(int $id){
        return PaperBook::where('book_category','=','paper')->where('id','=',$id)->first();
    }

    /**
     * add book
     * @return bool
     */
    public function createItem(array $data){
      return PaperBook::create($data);
    }

    /**
     * update book
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateItem(int $id,array $data){
       return PaperBook::where('id','=',$id)->update($data);
    }

    /**
     * delete book
     * @param int $id
     * @return mixed
     */
    public function deleteItem(int $id){
        return PaperBook::destroy($id);
    }
}
