<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PointsTransferResource extends JsonResource
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
          'id'              => $this->id,
          'points_number'   => $this->points_number,
          'created_at'      => $this->created_at,
          'updated_at'      => $this->updated_at,
          'from'            => $this->point_from_customer,
          'to'              => $this->point_to_customer,
        ];
    }
}
