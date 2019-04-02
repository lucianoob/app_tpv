<?php

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

class NewProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Product New Mutation',
        'description' => 'New products.'
    ];
    protected $sheet;
    protected $sheet_proccess;

    public function type()
    {
        return GraphQL::type('products');
    }

    public function args()
    {
        return [
            'filename' => [
                'type' => UploadType::getInstance(),
                'description' => 'The name of the file upload.'
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $filename = $args['filename'];
        if(file_exists($filename)) {
            $this->sheet_proccess = new SheetsController();
            $this->sheet = $this->sheet_proccess->store($filename);
            Excel::queueImport(new ProductsImport, $filename)->chain([
                new NotifyUserOfCompletedImport($this->sheet),
            ]);
        }
    }
}