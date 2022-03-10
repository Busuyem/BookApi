<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'isbn' => $this->isbn,
            'authors' => array($this->authors),
            'country' => $this->country,
            'number_of_pages' => $this->number_of_pages,
            'publisher' => $this->publisher,
            'release_date' => $this->release_date
        ];
    }
}
