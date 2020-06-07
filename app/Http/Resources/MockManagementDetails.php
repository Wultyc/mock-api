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
            "created_at" => !empty($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : "",
            "updated_at" => !empty($this->updated_at) ? $this->updated_at->format('Y-m-d H:i:s') : "",
            "deleted_at" => !empty($this->deleted_at) ? $this->deleted_at->format('Y-m-d H:i:s') : "",
        ];
    }
}
