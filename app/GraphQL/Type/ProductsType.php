<?php
namespace App\GraphQL\Type;

use App\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Products',
        'description' => 'A type of the products.',
        'model' => Product::class,
    ];
    
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