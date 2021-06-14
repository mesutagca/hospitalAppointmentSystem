<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $deleted_at=null;
        //return parent::toArray($request);
        if($this->deleted_at==null)
        {
            $deleted_at="-";
        }else{
            $deleted_at=$this->deleted_at;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'deleted_at' => $deleted_at,
            'doctors'=>$this->whenLoaded('doctors',function (){
                return $this->doctors;
            })
        ];
    }
}
