<?php

namespace App\Filament\Widgets;

use App\Models\Grade;
use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class GradeStudentsChart extends ChartWidget
{
    protected static ?string $heading = ' Bar Chart';

    protected function getData(): array
{
    
 
    return [
    ];
}

    protected function getType(): string
    {
        return 'bar';
    }
}
