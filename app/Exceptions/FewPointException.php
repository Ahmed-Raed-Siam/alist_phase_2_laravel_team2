<?php

namespace App\Exceptions;

use Exception;

class FewPointException extends Exception
{
    //
    public function render(){
        return response()->json(['errors' =>[ 'عملية خاطئة , يجب ان يكون عدد النقاط التي تريد تحويلها اقل من او مساوي لعدد نقاط الزبون']] , 400);
    }
}
