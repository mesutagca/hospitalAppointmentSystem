<?php


namespace App\Http\Resources\Folder;


use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
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
            'appointment_id' => $this->appointment_id,
            'diagnose_id' => $this->diagnose_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'appointment'=>$this->whenLoaded('appointment',function (){
                return $this->appointment;
            }),
            'treatment'=>$this->whenLoaded('treatment', function (){
                return $this->treatment;
            }),
        ];
    }
}
