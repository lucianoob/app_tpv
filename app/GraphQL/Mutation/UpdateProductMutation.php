<?php

namespace App\GraphQL\Mutation;

use App\Product;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Products Update Mutation',
        'description' => 'Update products.'
    ];

    public function type()
    {
        return GraphQL::type('products');
    }

    public function args()
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

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $product = Product::find($args['id']);
        if (!$product) {
            return null;
        }
        $product->category = $args['category'];
        $product->name = $args['name'];
        $product->free_shipping = $args['free_shipping'];
        $product->description = $args['description'];
        $product->price = $args['price'];
        $product->save();
        return $product;
    }
}