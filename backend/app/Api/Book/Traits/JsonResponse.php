<?php

namespace App\Api\Book\Traits;

trait JsonResponse
{

   public static function responseApi(string $status,int $code)
   {
       $MESSAGES = [
           'NOT_FOUND'=>'Resouce not found',
           'DELETED'=>'Resource deleted'
       ];
       return response()->json(['data'=>['message'=>$MESSAGES[$status]]],$code);
   }

   public static function responseErrors($errors){
       return response()->json(['data'=>['errors'=>$errors]],400);
   }

    public static function badRequest(){
        return response()->json(['data'=>['errors'=>'Bad request']],400);
    }
}
