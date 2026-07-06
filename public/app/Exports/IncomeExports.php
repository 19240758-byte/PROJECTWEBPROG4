<?php
namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IncomeExport implements FromCollection, WithHeadings, WithStyles
{
    protected $guideId;
    protected $month;

    public function __construct($guideId, $month)
    {
        $this->guideId = $guideId;
        $this->month = $month;
    }

    public function collection()
    {
        return Booking::where('guide_id', $this->guideId)
            ->whereMonth('created_at', substr($this->month, 5, 2))
            ->whereYear('created_at', substr($this->month, 0, 4))
            ->where('status', 'approved')
            ->select('id', 'booking_date', 'user_id', 'duration_hours', 'guide_cost', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Booking', 'Tanggal', 'Pelanggan ID', 'Durasi (jam)', 'Pendapatan', 'Dibuat'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
