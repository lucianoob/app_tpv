<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\SheetsController;
use App\Jobs\NotifyUserOfCompletedImport;

class ProductsController extends Controller
{   
    protected $filename;
    protected $sheet_proccess;
    protected $sheet;

    public function __construct() 
    {
        $this->filename = "products.xlsx";
    }

    public function index()
    {
        $products = DB::table('products')
            ->select('products.id', 'categories.name as category', 'products.name', 'products.free_shipping', 'products.description', 'products.price')
            ->join('categories', 'categories.id', '=', 'products.category')
            ->get();
        return json_encode($products, false);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function create()
    {
        return $this->process($this->filename);
    }

    public function store(Request $request)
    {
        return $this->process($request['filename']);
    }

    protected function process($filename)
    {
        $this->filename = $filename;
        if(file_exists($this->filename)) {
            $this->sheet_proccess = new SheetsController();
            $this->sheet = $this->sheet_proccess->store($this->filename);
            Excel::queueImport(new ProductsImport, $this->filename)->chain([
                new NotifyUserOfCompletedImport($this->sheet),
            ]);
        } else {
            return response()->json([
                'message' => 'File '.$this->filename.' not exist!',
            ], 404);
        }

        return response()->json([
            'message' => 'Sheet has queue (id:'.$this->sheet['id'].')',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Record not found!',
            ], 404);
        }
        $product->fill($request->all());
        $product->save();
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Record not found!',
            ], 404);
        }
        $product->delete();
    }
}