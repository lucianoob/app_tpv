<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019
 * @package     graphql
 */

namespace App\GraphQL\Type;

use App\Sheet;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Classe QraphQL for define Product Type
 */
class SheetsType extends GraphQLType
{
    /** Atributes of the information of class. */
    protected $attributes = [
        'name' => 'Sheets',
        'description' => 'A type of the sheets.',
        'model' => Sheet::class,
    ];

    /**
     * The fields of the type.
     *
     * @return object Return the structure of  the type.
     */
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
