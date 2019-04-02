<?php

namespace App\GraphQL\Type;

use App\Sheet;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SheetsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Sheets',
        'description' => 'A type of the sheets.',
        'model' => Sheet::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the sheet.'
            ],
            'filename' => [
                'type' => Type::string(),
                'description' => 'The filename of the sheet.'
            ],
            'hash' => [
                'type' => Type::string(),
                'description' => 'The hash of the sheet.'
            ],
            'start' => [
                'type' => Type::string(),
                'description' => 'Start date of the queue.'
            ],
            'queue' => [
                'type' => Type::int(),
                'description' => 'Status of the queue.'
            ],
            'stop' => [
                'type' => Type::string(),
                'description' => 'Stop date of the queue.'
            ],
            'process' => [
                'type' => Type::int(),
                'description' => 'Status of the process.'
            ],
        ];
    }
}