<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => ucfirst($this->firstname),
            'middlename' => ucfirst($this->middlename),
            'lastname' => ucfirst($this->lastname),
            'username' => $this->username,
            'full_name' => $this->full_name,
            'role' => ucfirst($this->roles[0]->name),
            'role_id' => ucfirst($this->roles[0]->id)
        ];
    }
}
