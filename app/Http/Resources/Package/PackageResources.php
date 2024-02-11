<?php

namespace App\Http\Resources\Package;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResources extends JsonResource
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
            'images'=> url('public/upload/package'.$this->logo),
            
           
        ];
    }
}
