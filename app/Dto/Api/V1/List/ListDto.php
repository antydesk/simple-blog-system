<?php

namespace App\Dto\Api\V1\List;


use App\Http\Requests\Api\V1\ListRequest;
use Spatie\LaravelData\Data;

class ListDto extends Data
{
    public int $perPage;
    public int $page;
    public ?string $q;

}

