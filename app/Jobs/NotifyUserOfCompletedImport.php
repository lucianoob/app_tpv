<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019 
 * @package     jobs
 */

namespace App\Jobs;

use App\Sheet;
use App\Http\Controllers\SheetsController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class Notify Job Import
 */
class NotifyUserOfCompletedImport implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    /** Sheet imported */
    protected $sheet;
    /** Sheet controller */
    protected $sheet_proccess;
    
    /**
     * Constructor of the class.
     *
     * @param  mixed $sheet
     *
     * @return void
     */
    public function __construct(Sheet $sheet)
    {
        $this->sheet_proccess = new SheetsController();
        $this->sheet = $sheet;
    }

    /**
     * Job execute notification.
     *
     * @return void
     */
    public function handle()
    {
        $this->sheet_proccess->update($this->sheet['id']);
    }
}