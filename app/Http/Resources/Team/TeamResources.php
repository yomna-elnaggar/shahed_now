<?php

namespace App\Http\Resources\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {     $user = $request->user();
            return [
            'id'=>$this->id,
            'name'=>$this->name,
            'images'=> url('public/upload/Team'.$this->logo),
            
           
        ];
    }
}
