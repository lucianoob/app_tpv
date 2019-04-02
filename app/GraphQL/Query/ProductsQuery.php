<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019 
 * @package     graphql
 */

namespace App\GraphQL\Query;

use App\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

/**
 * Classe QraphQL for Query Products
 */
class ProductsQuery extends Query
{
    /** Atributes of the information of class. */
    protected $attributes = [
        'name' => 'Products Query',
        'description' => 'A query of products'
    ];

    /**
     * Type of class.
     *
     * @return object Return an type product structure.
     */
    public function type()
    {
        return Type::listOf(GraphQL::type('products'));
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
                'name' => 'id',
                'type' => Type::int()
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
     * @return object Return an list of the products.
     */
    public function resolve($root, $args, SelectFields $fields)
    {
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id',$args['id']);
            }
        };
        $products = Product::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate();
        return $products;
    }
}