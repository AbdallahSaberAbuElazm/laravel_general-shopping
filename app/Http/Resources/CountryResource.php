<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'country_id'        =>$this->id,
            'country_name'      =>$this->country_name,
            'country_name_ar'   =>$this->country_name_ar,
        ];
    }
}
