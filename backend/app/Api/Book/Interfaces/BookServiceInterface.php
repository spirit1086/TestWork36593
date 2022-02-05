<?php

namespace App\Api\Book\Interfaces;

interface BookServiceInterface
{
    public function books(?int $per_page);
    public function book(int $id);
    public function createBook(array $data);
    public function updateBook(int $id,array $data);
    public function deleteBook(int $id);
}
