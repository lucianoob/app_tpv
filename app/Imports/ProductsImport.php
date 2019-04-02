<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\DB;

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function model(array $row)
    {
        $product = DB::table('products')->where('id', $row['id'])->exists();
        if(!$product) {
            return new Product([
            'id'     => $row['id'],
            'category'     => 123456,
            'name'     => $row['name'],
            'free_shipping'    => $row['free_shipping'], 
            'description' => $row['description'],
            'price' => $row['price']
            ]);
        } else {
            return NULL;
        }
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function chunkSize(): int
    {
        return 3;
    }
}
