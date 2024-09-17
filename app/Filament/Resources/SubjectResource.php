<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\ColorColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use App\Filament\Resources\GradeResource\RelationManagers\StudentsRelationManager;
use App\Filament\Resources\SubjectResource\RelationManagers\GradesRelationManager;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Subject Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject_name') -> required() -> maxLength(255),
                Forms\Components\TextInput::make('subject_order') -> required() -> maxLength(255),
                ColorPicker::make('color'),
          
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject_name') -> searchable(),
                Tables\Columns\TextColumn::make('subject_order'),
                ColorColumn::make('color'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make() -> label(''),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Grid::make(2)
                ->schema([
                    Section::make('Subject Details')
                        ->schema([
                           
                            TextEntry::make('subject_name')->label('Subject Name'),
                            TextEntry::make('subject_order')->label('Subject Order'),
                            TextEntry::make('color')->label('Subject Color'),
                        ]),
                    Section::make('Students')
                        ->schema([
                            TextEntry::make('students.first_name')->default('No Students')
                                ->listWithLineBreaks()
                                ->bulleted(),
                        ]),
                    Section::make('Grades')
                        ->schema([
                            TextEntry::make('grades.grade_name')->default('No Grades')
                                ->listWithLineBreaks()
                                ->bulleted(),
                        ])
                ])
        ])->columns(2);
                    
    }

    public static function getRelations(): array
    {
        return [
            StudentsRelationManager::class,
            GradesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}
