<?php

namespace App\Http\Resources;

use App\Http\Controllers\Traits\ResponserTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClassPackageCollection extends ResourceCollection
{
    use ResponserTrait;
    public function __construct($resource,  $queryString = "")
    {
        $this->pagination = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage(),
            'next_pages' => $resource->nextPageUrl() ? $resource->nextPageUrl().'&'.$queryString : null,
            'previous_pages' => $resource->previousPageUrl() ? $resource->previousPageUrl().'&'.$queryString : null
            
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => 200,
            'message' => 'success',
            'pagination' => $this->pagination,
            'data' => $this->collection->toArray()
            
        ];
    }
}
