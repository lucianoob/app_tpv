<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019 
 * @package     types
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product Type
 */
class Product extends Model
{
    /** Fields that are filled in  */
    protected $fillable = [
        'id', 'category', 'name', 'free_shipping', 'description', 'price'
    ];
}
