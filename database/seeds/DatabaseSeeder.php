<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019
 * @package     database
 * @subpackage  seeds
 */

use Illuminate\Database\Seeder;

/**
 * Class Seeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
    }
}
