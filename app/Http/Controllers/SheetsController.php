<?php

namespace App\Http\Controllers;

use App\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SheetsController extends Controller
{
    public function index()
    {
        $sheets = DB::table('sheets')->get();
        return json_encode($sheets, false);
    }

    public function show(Sheet $sheet)
    {
        return $sheet;
    }

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

    public function destroy($id)
    {
        $sheet = Sheet::find($id);
        if (!$sheet) {
            return NULL;
        }
        $sheet->delete();
    }
}