<?php
/**
 * $this
 *
 * @author      Luciano O. Borges <luciano@iautomate.com.br>
 * @copyright   2019 
 * @package     controllers
 */

namespace App\Http\Controllers;

use App\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Classe Sheets Controller
 */
class SheetsController extends Controller
{
    /**
     * Show all sheets.
     *
     * @return object Return an array of sheet objects.
     */
    public function index()
    {
        $sheets = DB::table('sheets')->get();
        return json_encode($sheets, false);
    }

    /**
     * Show an sheet from id.
     *
     * @param  mixed $sheet An sheet object.
     *
     * @return object Return an sheet object.
     */
    public function show(Sheet $sheet)
    {
        return $sheet;
    }

    /**
     * Create an sheet from sheet object.
     *
     * @return object Return an sheet object.
     */
    public function store($file)
    {
        $sheet = new Sheet([
            'filename' => $file,
            'hash'     => hash_file('md5', $file),
            'start'     => date('Y-m-d H:i:s'),
            'queue'     => 1,
            'process'     => 0
        ]);
        $sheet->save();
        return $sheet;
    }

    /**
     * Update an sheet from sheet object.
     *
     * @return object Return an sheet object.
     */
    public function update($id)
    {
        $sheet = Sheet::find($id);
        if (!$sheet) {
            return NULL;
        }
        $sheet->fill([
            'queue' => 0,
            'stop' => date('Y-m-d H:i:s'),
            'process' => 1
        ]);
        $sheet->save();
        return response()->json($sheet);
    }

    /**
     * Delete an sheet from sheet object.
     *
     * @param  mixed $id Id of the sheet.
     *
     * @return void
     */
    public function destroy($id)
    {
        $sheet = Sheet::find($id);
        if (!$sheet) {
            return NULL;
        }
        $sheet->delete();
    }
}