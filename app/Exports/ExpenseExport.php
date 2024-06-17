<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpenseExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;
    protected $counter = 0;

    protected $startDate;
    protected $endDate;

    public function __construct(?string $startDate, ?string $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        $query = Expense::query();

        if ($this->startDate && $this->endDate) {
            $query->with('products')->whereBetween('date', [$this->startDate, $this->endDate])->orderBy('date', 'desc')->get();
        }else{
            $query->with('products')->orderBy('date', 'desc')->get();
        }

        return $query;
    }

    public function map($row): array
    {
        $rows = [];
        $this->counter++;

        foreach ($row->products as $index => $product) {
            if ($index === 0) {
                $rows[] = [
                    'No' => $this->counter,
                    'Shift' => $row->shift,
                    'Nama Produk' => $product->name,
                    'Harga Produk' => 'Rp' . number_format($product->price,0,',','.'),
                    'Jumlah Produk' => $product->quantity,
                    'Total Harga Produk' => 'Rp' . number_format($product->total_price,0,',','.'),
                    'Keterangan Produk' => $product->note ?? '-',
                    'Total Pengeluaran' => 'Rp' . number_format($row->total_price,0,',','.'),
                    'Tanggal' => Carbon::parse($row->date)->format('d-m-Y'),
                ];
            } else {
                $rows[] = [
                    'No' => null,
                    'Shift' => null,
                    'Nama Produk' => $product->name,
                    'Harga Produk' => 'Rp' . number_format($product->price,0,',','.'),
                    'Jumlah Produk' => $product->quantity,
                    'Total Harga Produk' => 'Rp' . number_format($product->total_price,0,',','.'),
                    'Keterangan Produk' => $product->note ?? '-',
                ];
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'No',
            'Shift',
            'Nama Produk',
            'Harga Produk',
            'Jumlah Produk',
            'Total Harga Produk',
            'Keterangan Produk',
            'Total Pengeluaran',
            'Tanggal',
        ];
    }
}
