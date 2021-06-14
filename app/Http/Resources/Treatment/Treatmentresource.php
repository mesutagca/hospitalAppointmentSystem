<?php

namespace App\Http\Resources\Treatment;

use Illuminate\Http\Resources\Json\JsonResource;

class Treatmentresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'folder_id' => $this->folder_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'recipe'=>$this->whenLoaded('recipe',function (){
                return $this->recipe;
            }),

        ];

    }
}
