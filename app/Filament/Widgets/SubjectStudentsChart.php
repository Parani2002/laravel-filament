<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;


class SubjectStudentsChart extends ChartWidget

{
    protected static ?string $heading = 'Subject Students Overview';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        
            $labels = Subject::take(5)->pluck('subject_name')->toArray();

            // $data = Subject::join('grades', 'students.grade_id', '=', 'grades.id')
            //                ->select('grades.grade_name', DB::raw('count(students.id) as total'))
            //                ->groupBy('subjects.subject_name')
            //                ->get();
            // $studentCounts = $data->pluck('total')->toArray();
           
                return [
                    'datasets' => [
                        [
                            'label' => 'Students',
                            
                            'data'=> [300, 50, 100,20,80],
                            'backgroundColor'=> [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)',
                                '#1c1515',
                                '#e89b9b'
                              ],
                              'hoverOffset'=> 4
                        ],
                    ],
                    'labels' => $labels,
                ];
    
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
