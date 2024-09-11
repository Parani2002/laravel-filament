<?php

namespace App\Filament\Widgets;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Subject;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Students', Student::query()->count()),
            Stat::make('Grades', Grade::query()->count()),
            Stat::make('Subjects', Subject::query()->count()),
           
        ];
    }
}
