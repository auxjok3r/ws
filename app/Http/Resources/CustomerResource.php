<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'customer',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'ci' => $this->resource->ci,
                'phone' => $this->resource->phone,
                'email' => $this->resource->email,
            ],
            'links' => [
                'self' => route('api.v1.customers.show', $this->resource)
            ],
        ];
    }
}
