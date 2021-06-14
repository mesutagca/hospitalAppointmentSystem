<?php


namespace App\Http\Resources\Doctor;


use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'branch_id' => $this->branch_id,
            'status'=>$this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'user'=>$this->whenLoaded('user',function (){
                return $this->user;
            }),
            'branch'=>$this->whenLoaded('branch',function (){
                return $this->branch;
            }),
            'appointments'=>$this->whenLoaded('appointments',function (){
                return $this->appointments;
            }),
            'doctorDocuments'=>$this->whenLoaded('doctorDocuments',function (){
                return $this->doctorDocuments;
            }),

        ];
    }

}
