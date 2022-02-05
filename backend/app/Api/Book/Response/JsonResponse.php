<?php

namespace App\Api\Book\Response;

use App\Http\Controllers\Controller;

class JsonResponse extends Controller
{
    const MESSAGES=[
        'NOT_FOUND'=>'Resouce not found',
        'DELETED'=>'Resource deleted'
    ];

   public static function responseApi(string $status,int $code)
   {
       return response()->json(['message'=>self::MESSAGES[$status]],$code);
   }
}
