<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019 
 * @package     tests
 */

namespace Tests\Unit;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class Products Tests
 */
class ProductsTest extends TestCase
{   
   
    /**
     * Test of products create from local file.
     *
     * @return void
     */
    public function testProductsCreate()
    {
        $response = $this->json('GET', '/api/products/create');
        sleep(5);
        $response->assertResponseStatus('201')
            ->seeJson([
                'status' => 'ok',
            ]);
    }

    /**
     * Test of products create from upload file.
     *
     * @return void
     */
    public function testProductsStore()
    {
        Storage::fake('public');
 
        $response = $this->json('POST', '/api/products/', [
            'filename' => new UploadedFile(public_path('/products.xlsx'), 'product_test.xlsx', null, null, null, true),
        ]);

        sleep(5);
        $response->assertResponseStatus('201')
            ->seeJson([
                'status' => 'ok',
            ]);
    }

    /**
     * Test of show all products.
     *
     * @return void
     */
    public function testProductsIndex()
    {
        $this->json('GET', '/api/products', [])
            ->assertResponseOk()
            ->seeJson([
                'id' => 1001,
            ]);
    }

    /**
     * Test of update an product.
     *
     * @return void
     */
    public function testProductsUpdate()
    {
        $last_product = DB::table('products')->where('id', '1002')->first();
        $this->json('PUT', '/api/products/'.$last_product->id,
            [
                'category'    => 123456,
                'name'    => 'Ferramenta de Teste',
                'free_shipping'    => 1,
                'description'    => 'Ferramenta alterada por meio de um teste.',
                'price'   =>  200
            ])
            ->assertResponseOk();
    }

    /**
     * Test of show an product.
     *
     * @return void
     */
    public function testProductsShow()
    {
        $this->json('GET', '/api/products/1001', [])
            ->assertResponseOk()
            ->seeJson([
                'id' => 1001,
            ]);
    }

    /**
     * Test of delete an product.
     *
     * @return void
     */
    public function testProductsDelete()
    {
        $last_product = DB::table('products')->where('id', '1001')->first();
        $this->json('DELETE', '/api/products/'.$last_product->id)
            ->assertResponseOk();
    }
}
