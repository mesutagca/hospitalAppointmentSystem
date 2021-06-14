<?php

namespace App\Http\Resources\Medicine;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
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
          'id'=>$this->id,
            'medicine_company_id'=>$this->medicine_company_id,
            'name'=>$this->name,
            'active_ingredient'=>$this->active_ingredient,
            'barcode'=>$this->barcode,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'deleted_at' => $deleted_at,
            'medicine_company'=>$this->whenLoaded('medicineCompany',function (){
                return $this->medicineCompany;
            })
        ];
    }
}
