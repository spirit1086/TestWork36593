<?php
namespace App\Api\Book\Interfaces;

interface BookRepositoryInterface
{
    public function getItems(int $per_page);
    public function getItem(int $id);
    public function createItem(array $data);
    public function updateItem(int $id,array $data);
    public function deleteItem(int $id);
}
