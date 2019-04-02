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
use Rebing\GraphQL\Support\UploadType;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\SheetsController;
use App\Jobs\NotifyUserOfCompletedImport;

/**
 * Classe QraphQL for New Product
 */
class NewProductMutation extends Mutation
{
    /** Atributes of the information of class. */
    protected $attributes = [
        'name' => 'Product New Mutation',
        'description' => 'New products.'
    ];
    /** Sheet imported */
    protected $sheet;
    /** Sheet controller */
    protected $sheet_proccess;

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
            'filename' => [
                'type' => UploadType::getInstance(),
                'description' => 'The name of the file upload.'
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
     * @return void
     */
    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $filename = $args['filename'];
        if (file_exists($filename)) {
            $this->sheet_proccess = new SheetsController();
            $this->sheet = $this->sheet_proccess->store($filename);
            Excel::queueImport(new ProductsImport, $filename)->chain([
                new NotifyUserOfCompletedImport($this->sheet),
            ]);
        }
    }
}
