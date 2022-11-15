<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryManagementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [

            "id" => $this->id,
            "address" => $this->address ,
            "mobile" => $this->mobile ,
            "evaluation" => $this->evaluation ,
            "total_amount" => $this->total_amount ,
            "status" => $this->status,
            "order_id" => $this-> order_id,
            "driver_id" => $this->driver_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "status_name" => $this->status_name,
            "oderer" => $this-> order,
            "driver" => $this-> driver,

        ];
    }
}
