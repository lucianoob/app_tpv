<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019
 * @package     tests
 */

namespace Tests\Unit;

use App\Sheet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

/**
 * Class Sheets Tests
 */
class SheetsTest extends TestCase
{
    /**
     * Test of show all sheets.
     *
     * @return void
     */
    public function testSheetsIndex()
    {
        $this->json('GET', '/api/sheets', [])
            ->assertResponseOk()
            ->seeJson([
                'id' => 1,
            ]);
    }

    /**
     * Test of show an sheet.
     *
     * @return void
     */
    public function testSheetsShow()
    {
        $this->json('GET', '/api/sheets/1', [])
            ->assertResponseOk()
            ->seeJson([
                'id' => 1,
            ]);
    }
}
