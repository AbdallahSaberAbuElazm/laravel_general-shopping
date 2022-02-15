<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GovernorateResource extends JsonResource
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
            'governorate_id'        => $this->id,
            'governorate_name_ar'      =>$this->governorate_name_ar,
            'governorate_name_en'       =>$this->governorate_name_en,
        ];
    }
}
