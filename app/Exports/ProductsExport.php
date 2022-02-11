<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Art number',
            'Name',
            'Status',
            'Description',
            'Created at',
            'Updated at',
        ];
    }
}
