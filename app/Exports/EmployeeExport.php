<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeExport implements FromCollection, WithEvents, WithStyles
{
    protected $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->employees->map(function ($employee) {
            return [
                'Name' => $employee->name,
                'Staff Identity Card No' => $employee->staffIdentityCardNo,
                'Department' => $employee->department,
                'Position' => $employee->position,
                'Date Joined' => $employee->dateJoined,
                'Date In The Present Position' => $employee->dateInThePresentPosition,
            ];
        });
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1:H2')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:G1')->getAlignment()->setVertical('center');

        $sheet->getStyle('A1:G2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getColumnDimension('A')->setWidth(4);
        $sheet->getColumnDimension('B')->setWidth(13);
        $sheet->getColumnDimension('C')->setWidth(13);
        $sheet->getColumnDimension('D')->setWidth(26);
        $sheet->getColumnDimension('E')->setWidth(12);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(12);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);

                $sheet->setCellValue('A1', 'Daftar Karyawan Yulia Hotel');

                // Set baris pertama untuk header
                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Nama'); 
                $sheet->setCellValue('C2', 'Staff Identity Card No');
                $sheet->setCellValue('D2', 'Department');
                $sheet->setCellValue('E2', 'Posisi');
                $sheet->setCellValue('F2', 'Joining Date');
                $sheet->setCellValue('G2', 'Date in The Present Position');

                $row = 3;
                $no = 1;

                // Ambil data karyawan berdasarkan departemen dan urutkan berdasarkan departemen
                $employees = Employee::orderBy('department')->get();

                foreach ($employees as $employee) {
                    $sheet->setCellValue('A' . $row, $no);
                    $sheet->setCellValue('B' . $row, $employee->name);
                    $sheet->setCellValue('C' . $row, $employee->staffIdentityCardNo);
                    $sheet->setCellValue('D' . $row, $employee->department);
                    $sheet->setCellValue('E' . $row, $employee->position);
                    $sheet->setCellValue('F' . $row, $employee->dateJoined);
                    $sheet->setCellValue('G' . $row, $employee->dateInThePresentPosition);

                    $sheet->getStyle('A3:G' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $row++;
                    $no++;
                }

                
            },
        ];
    }
}
