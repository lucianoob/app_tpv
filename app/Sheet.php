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
 * Class Sheet Type
 */
class Sheet extends Model
{
    /** Fields that are filled in  */
    protected $fillable = [
        'filename', 'hash', 'start', 'queue', 'stop', 'process'
    ];
}
