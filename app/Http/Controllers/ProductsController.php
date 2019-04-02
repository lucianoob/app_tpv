<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019 
 * @package     controllers
 */

namespace App\Http\Controllers;

use App\Product;
use App\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\SheetsController;
use App\Jobs\NotifyUserOfCompletedImport;

/**
 * Classe Products Controller
 */
class ProductsController extends Controller
{   
    /** Filename of the sheet. */
    protected $filename;
    /** Sheet imported */
    protected $sheet;
    /** Sheet controller */
    protected $sheet_proccess;

    /**
     * Constructor of the class.
     */
    public function __construct() 
    {
        $this->filename = public_path('/products.xlsx');
    }

    /**
     * Show all prodcuts.
     *
     * @return object Return an array of product objects.
     */
    public function index()
    {
        $products = DB::table('products')
            ->select('products.id', 'categories.name as category', 'products.name', 'products.free_shipping', 'products.description', 'products.price')
            ->join('categories', 'categories.id', '=', 'products.category')
            ->get();
        return json_encode($products, false);
    }

    /**
     * Show an product from id.
     *
     * @param  mixed $product An product object.
     *
     * @return object Return an product object.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Create products from import local file.
     *
     * @return object Return status queue import file.
     */
    public function create()
    {
        return $this->process($this->filename);
    }

    /**
     * Create products from import upload file.
     *
     * @return object Return status queue import file.
     */
    public function store(Request $request)
    {
        return $this->process($request['filename']);
    }

    /**
     * Process the sheet file importing all products.
     *
     * @param  string $filename The sheet filename.
     *
     * @return object Return status queue import file.
     */
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
                'status' => 'error'
            ], 404);
        }

        return response()->json([
            'message' => 'Sheet has queue (id:'.$this->sheet['id'].')',
            'status' => 'ok'
        ], 201);
    }

    /**
     * Update an product from product object.
     *
     * @param  object $request An request.
     * @param  int $id Id of the product.
     *
     * @return Return an product object.
     */
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

    /**
     * Delete an product from product object.
     *
     * @param  mixed $id Id of the product.
     *
     * @return void
     */
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