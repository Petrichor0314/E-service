<?php

namespace App\Exports;

use App\Models\Mark;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MarksExport implements FromView
{
    protected $studentsWithMarks;

    public function __construct($studentsWithMarks)
    {
        $this->studentsWithMarks = $studentsWithMarks;
    }

    public function view(): View
    {
        return view('coordinator.export.marks_excel', [
            'studentsWithMarks' => $this->studentsWithMarks
        ]);
    }
}
