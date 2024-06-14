<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $attendanceData;

    public function __construct($attendanceData)
    {
        $this->attendanceData = $attendanceData;
    }

    public function collection()
    {
        return collect($this->attendanceData);
    }

    public function headings(): array
    {
        return [
            'Identifiant étudiant',
            'Prénom',
            'Nom',
            'Nom de la classe',
            'Nom de la matière',
            'Date d\'assiduité',
            'Heure de début',
            'Heure de fin',
            'Assiduité',
        ];
    }
}
