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
            Stat::make('Students', Student::query()->count())->chart([7,2,10,3,15,4,17])->color('primary')->description('All Students from database')->descriptionIcon('heroicon-o-academic-cap'),
            Stat::make('Grades', Grade::query()->count())->chart([7,2,10,3,15,4,17])->color('success')->description('All Grades from database')->descriptionIcon('heroicon-o-user-group'),
            Stat::make('Subjects', Subject::query()->count())->chart([7,2,10,3,15,4,17])->color('danger')->description('All Subjects from database')->descriptionIcon('heroicon-o-book-open'),
           
        ];
    }
}
