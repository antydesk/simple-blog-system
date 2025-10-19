<?php

namespace App\GraphQL\InputTypes;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class CreatePostInput extends InputType
{
    protected $attributes = ['name' => 'CreatePostInput'];

    public function fields(): array
    {
        return [
            'title' => ['type' => Type::nonNull(Type::string()), 'rules' => ['required', 'string', 'max:255']],
            'content' => ['type' => Type::nonNull(Type::string()), 'rules' => ['required', 'string']],
        ];
    }
}
