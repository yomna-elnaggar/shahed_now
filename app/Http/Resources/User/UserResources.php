<?php
namespace App\Http\Resources\User;

use App\Models\Country;
use App\Models\Government;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $user = $this->resource;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'last_name'=>$user->last_name,
            'mobile_number' => $user->mobile_number,
            'email' => $user->email,
            'image'=>url('public/'.$user->image),
        ];
    }
}

