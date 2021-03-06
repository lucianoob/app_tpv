<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019
 * @package     database
 * @subpackage  migrations
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Sheets Migration
 */
class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sheets')) {
            Schema::create('sheets', function (Blueprint $table) {
                $table->increments('id');
                $table->string('filename');
                $table->string('hash');
                $table->datetime('start');
                $table->integer('queue');
                $table->datetime('stop')->nullable();
                ;
                $table->integer('process');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sheets');
    }
}
