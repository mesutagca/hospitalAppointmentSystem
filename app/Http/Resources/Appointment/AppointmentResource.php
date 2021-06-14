<?php

namespace App\Http\Resources\Appointment;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AppointmentResource extends JsonResource
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
            'doctor_id' => $this->doctor_id,
            'patient_id' => $this->patient_id,
            'created_at' => $this->created_at,
            'deleted_at' => $deleted_at,
            //'appointment_time' =>Carbon::parse($this->appointment_time)->format('d/m/Y H:i:s'),
            'appointment_time'=>$this->appointment_time,
            'doctor'=>$this->whenLoaded('doctor',function (){
                return $this->doctor;
            }),
            'patient'=>$this->whenLoaded('patient',function (){
                return $this->patient;
            }),
            'folder'=>$this->whenLoaded('folder',function (){
                return $this->folder;
            })
        ];

    }
}
