<?php

namespace App\GraphQL\InputTypes;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class CreateCommentInput extends InputType
{
    protected $attributes = ['name' => 'CreateCommentInput'];

    public function fields(): array
    {
        return [
            'post_id' => ['type' => Type::nonNull(Type::id()), 'rules' => ['required', 'integer', 'exists:posts,id']],
            'content' => ['type' => Type::nonNull(Type::string()), 'rules' => ['required', 'string']],
        ];
    }
}
