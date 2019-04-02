<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019 
 * @package     graphql
 */

namespace App\GraphQL\Type;

use App\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * Classe QraphQL for define Product Type
 */
class ProductsType extends GraphQLType
{
     /** Atributes of the information of class. */
    protected $attributes = [
        'name' => 'Products',
        'description' => 'A type of the products.',
        'model' => Product::class,
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
                'description' => 'The id of the product.'
            ],
            'category' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the category.'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the product.'
            ],
            'free_shipping' => [
                'type' => Type::int(),
                'description' => 'Free shipping status.'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of the product.'
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'The price of the product.'
            ]
        ];
    }
}