<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{

    public function toArray($request)
    {
//        return parent::toArray($request);
            if($this->key == 'background_terms'){
                return [
                    'background_terms'=>  $this->value,
                ];
            }else{
                return [
                    'terms'=>  $this->value,
                ];
            }



    }
}
