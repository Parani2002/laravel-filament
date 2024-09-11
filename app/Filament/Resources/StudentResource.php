<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Filament\Resources\StudentResource\RelationManagers\SubjectsRelationManager;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

 

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name') ->label('First Name') -> required() -> maxLength(50),
                Forms\Components\TextInput::make('last_name')-> label('Last Name')-> required() -> maxLength(50),
                Select::make('grade_id')
                    ->required()
                    ->label('Grade')
                    ->options(Grade::all()->pluck('grade_name', 'id'))
                    ->searchable()-> native(false)
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                ->label('First name')
                ->searchable(),
            Tables\Columns\TextColumn::make('last_name')
                ->searchable(),
            Tables\Columns\TextColumn::make('grade.grade_name')
                ->numeric()
                ->sortable(),
            
            
                
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make()-> label(''),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make() ,
                
             
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
            return $infolist
                    ->schema([
                        ImageEntry::make('header_image') -> label('Student Image') -> columns(1),
                        TextEntry::make('first_name') -> label('First Name'),
                        TextEntry::make('last_name') -> label('Last Name'),
                        TextEntry::make('grade.grade_name') -> label('Grade'),
                        TextEntry::make('subjects.subject_name')
                            ->listWithLineBreaks()
                            ->bulleted()
                        

  


                    ]) ->columns(2);
                
                        
    }


    public static function getRelations(): array
    {
        return [
            SubjectsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
