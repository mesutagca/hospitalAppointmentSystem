<?php


namespace App\Http\Resources\Diagnose;

use Illuminate\Http\Resources\Json\JsonResource;

class DiagnoseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
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
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'folders'=>$this->whenLoaded('folders',function (){
                return $this->folders;
            }),
            'deleted_at' =>$deleted_at,
        ];

    }
}
