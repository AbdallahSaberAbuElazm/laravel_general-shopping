<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'city_id'       =>$this->id,
            'city_name_ar'  =>$this->city_name_ar,
            'city_name_en'  =>$this->city_name_ar,
        ];
    }
}
