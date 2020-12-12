<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerLockedCollection extends ResourceCollection
{

    public $collects = CustomerResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => route('api.v1.customers_locked.index')
            ],
            'meta' => [
                'customers_count' => $this->collection->count()
            ]
        ];
    }
}
