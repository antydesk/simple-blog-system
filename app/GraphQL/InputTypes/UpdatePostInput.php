<?php

namespace App\GraphQL\InputTypes;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class UpdatePostInput extends InputType
{
    protected $attributes = ['name' => 'UpdatePostInput'];

    public function fields(): array
    {
        return [
            'title'   => ['type' => Type::string(), 'rules' => ['sometimes','string','max:255']],
            'content' => ['type' => Type::string(), 'rules' => ['sometimes','string']],
        ];
    }
}
