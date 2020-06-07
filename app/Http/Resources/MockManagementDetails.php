<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MockManagementDetails extends JsonResource
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
            "endpoint" => $this->endpoint,
            "enabled" => ($this->deleted_at == null) ? true : false,
            "query" => $this->query,
            "payload" => $this->payload,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at
        ];
    }
}
