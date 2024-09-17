<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Filament\Resources\GradeResource\RelationManagers;
use App\Filament\Resources\GradeResource\RelationManagers\StudentsRelationManager;
use App\Filament\Resources\StudentResource\RelationManagers\SubjectsRelationManager;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ColorColumn;
use Filament\Forms\Components\ColorPicker;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\ColorEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Grade Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('grade_name') -> required() -> maxLength(255) -> rules('required'),
                Forms\Components\TextInput::make('grade_group') ->integer() -> required(),
                Forms\Components\TextInput::make('grade_order') ->inputMode('decimal') ->  required(),
                ColorPicker::make('grade_color')->required()

                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('grade_name') -> searchable(),
                Tables\Columns\TextColumn::make('grade_group'),
                Tables\Columns\TextColumn::make('grade_order'),
                ColorColumn::make('grade_color'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SubjectsRelationManager::class,
            StudentsRelationManager::class
        ];
    }
    public static function infolist(Infolist $infolist): Infolist
    {
            // return $infolist
            //         ->schema([
            //             TextEntry::make('grade_name') -> label('Grade'),
            //             TextEntry::make('grade_group') -> label('Group'),
            //             TextEntry::make('grade_order') -> label('Order'),
            //             ColorEntry::make('grade_color') -> label('Color')->copyable(),
            //             TextEntry::make('subjects.subject_name')->weight(FontWeight::Bold)
            //                 ->listWithLineBreaks()
            //                 ->bulleted()
            //         ]) ->columns(2);
            return $infolist
        ->schema([
            Grid::make(2)
                ->schema([
                    Section::make('Grade Details')
                        ->schema([
                            TextEntry::make('grade_name') -> label('Grade'),
                            TextEntry::make('grade_group') -> label('Group'),
                            TextEntry::make('grade_order') -> label('Order'),
                            ColorEntry::make('grade_color') -> label('Color')->copyable()
                        ])->columns(2),
                    Section::make('Subjects')
                        ->schema([
                            TextEntry::make('subjects.subject_name')->default('No Subjects')
                                ->listWithLineBreaks()
                                ->bulleted(),
                        ]),
                    Section::make('Students')
                        ->schema([
                            TextEntry::make('students.first_name')->default('No Students')
                                ->listWithLineBreaks()
                                ->bulleted(),
                        ])
                ])
        ])->columns(2);
                        
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}
