<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Student;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestStudents extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Student::query()
            )
            ->defaultSort('id','desc')
            ->columns([
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('grade.grade_name')

            ]);
    }
}
