<?php

// app/Exports/StudentsExport.php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::getStudentExport();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Prénom',
            'Nom',
            'Sexe',
            'CIN',
            'CNE',
            'Classe',
            'Date de naissance',
            'Date d\'inscription',
            'Numéro de mobile',
            'Email'
                 
            
        ];
    }
}

