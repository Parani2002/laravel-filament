<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Student;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class GradeStudentsChart extends ChartWidget
{
    protected static ?string $heading = 'GradeStudents Overview';
    protected static ?int $sort = 2;
    

    protected function getData(): array
    {
        $labels = Grade::take(5)->pluck('grade_name')->toArray();

        $data = Student::join('grades', 'students.grade_id', '=', 'grades.id')
                       ->select('grades.grade_name', DB::raw('count(students.id) as total'))
                       ->groupBy('grades.grade_name')
                       ->get();
        $studentCounts = $data->pluck('total')->toArray();
       
            return [
                'datasets' => [
                    [
                        'label' => 'Students',
                        'data' => $studentCounts,
                    ],
                ],
                'labels' => $labels,
            ];
        
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
