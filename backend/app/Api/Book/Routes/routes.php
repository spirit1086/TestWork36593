<?php
Route::group( [ 'namespace' => 'App\Api\Book\Http','prefix'=> 'api','middleware' => ['api']], function()
{
    Route::get('/books','BookController@getBooks')->name('books');
    Route::get('/book/{id}','BookController@getBook')->name('book');
    Route::post('/book/create','BookController@addBook')->name('addBook');
    Route::patch('/book/update/{id}','BookController@updateBook')->name('updateBook');
    Route::delete('/book/delete/{id}','BookController@deleteBook')->name('deleteBook');
});
