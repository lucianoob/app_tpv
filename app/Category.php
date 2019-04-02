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
 * Class Category Type
 */
class Category extends Model
{
    /** Fields that are filled in  */
    protected $fillable = [
        'name', 'description'
    ];
}
