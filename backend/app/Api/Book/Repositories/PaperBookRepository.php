<?php
namespace  App\Api\Book\Repositories;

use App\Api\Book\Interfaces\BookRepositoryInterface;
use App\Api\Book\Models\PaperBook;

class PaperBookRepository implements BookRepositoryInterface
{
    private $paperBook;

    public function __construct()
    {
        $this->paperBook = new PaperBook();
    }

    /**
     * get list books
     * @return PaperBook[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getItems(int $per_page)
    {
        return $this->paperBook->books($per_page);
    }

    /**
     * get item book
     * @param int $id
     * @return mixed
     */
    public function getItem(int $id)
    {
        return $this->paperBook->bookItem($id);
    }

    /**
     * add book
     * @param array $data
     * @return bool
     */
    public function createItem(array $data)
    {
        return $this->paperBook->createItem($data);
    }

    /**
     * update book
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateItem(int $id, array $data)
    {
       return $this->paperBook->updateItem($id,$data);
    }

    /**
     * delete book
     * @param int $id
     * @return mixed
     */
    public function deleteItem(int $id)
    {
        return $this->paperBook->deleteItem($id);
    }
}
