<?php

namespace App\Exports;

use App\Models\Presence;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PresenceExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
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
        $query = Presence::query();

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('date', [$this->startDate, $this->endDate])->orderBy('date', 'desc')->get();
        }else{
            $query->orderBy('date', 'desc')->get();
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'No',
            'Shift',
            'Sesi',
            'Karyawan',
            'Status',
            'Keterangan',
            'Tanggal'
        ];
    }

    public function map($row): array
    {
        $this->counter++;

        return [
            $this->counter,
            $row->shift,
            $row->session,
            $row->name,
            $row->status,
            $row->status_note ?? '-',
            Carbon::parse($row->date)->format('d-m-Y')
        ];
    }
}
