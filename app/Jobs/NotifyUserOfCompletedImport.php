<?php

namespace App\Jobs;

use App\Sheet;
use App\Http\Controllers\SheetsController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUserOfCompletedImport implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    protected $sheet;
    protected $sheet_proccess;
    
    public function __construct(Sheet $sheet)
    {
        $this->sheet_proccess = new SheetsController();
        $this->sheet = $sheet;
    }

    public function handle()
    {
        $this->sheet_proccess->update($this->sheet['id']);
    }
}