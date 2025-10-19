<?php

namespace App\Dto\Api\V1\List;

use Spatie\LaravelData\Data;

class ListDto extends Data
{
    public int $perPage;

    public int $page;

    public ?string $q;
}
