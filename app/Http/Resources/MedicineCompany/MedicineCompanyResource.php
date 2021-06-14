<?php

namespace App\Http\Resources\MedicineCompany;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicineCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
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
            'address'=>$this->address,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'deleted_at' => $deleted_at,
            ];
    }
}
