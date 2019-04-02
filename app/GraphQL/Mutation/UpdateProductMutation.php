<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019 
 * @package     graphql
 */

namespace App\GraphQL\Mutation;

use App\Product;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Classe QraphQL for Update Product
 */
class UpdateProductMutation extends Mutation
{
    /** Atributes of the information of class. */
    protected $attributes = [
        'name' => 'Products Update Mutation',
        'description' => 'Update products.'
    ];

    /**
     * Type of class.
     *
     * @return object Return an type product structure.
     */
    public function type()
    {
        return GraphQL::type('products');
    }

    /**
     * The arguments receives for the class.
     *
     * @return object Return struture of the arguments.
     */
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

    /**
     * Resolve the call os the class.
     *
     * @param  mixed $root
     * @param  mixed $args
     * @param  mixed $fields
     * @param  mixed $info
     *
     * @return object Return the product updated.
     */
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