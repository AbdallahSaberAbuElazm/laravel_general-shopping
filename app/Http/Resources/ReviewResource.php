<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'review_id'       => $this->id,
            'review'          => $this->review,
            'stars'           => $this->stars,
            'reviewer'        =>new UserResource($this->customer),
        ];
    }
}
