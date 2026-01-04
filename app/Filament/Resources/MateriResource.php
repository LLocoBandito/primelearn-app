<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriResource\Pages;
use App\Filament\Resources\MateriResource\RelationManagers\StepsRelationManager;
use App\Models\Materi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar Materi')
                    ->schema([
                        Select::make('fase_id')
                            ->relationship('fase', 'name') // DIPERBAIKI: Menggunakan 'name' sesuai database
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Parent Fase'),
                        
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Judul Materi'),
                        
                        TextInput::make('order')
                            ->numeric()
                            ->default(1)
                            ->label('Urutan'),
                    ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')->sortable()->label('No.'),
                TextColumn::make('title')->searchable()->label('Materi'),
                TextColumn::make('fase.name') // DIPERBAIKI: Menggunakan 'name'
                    ->sortable()
                    ->label('Fase'),
                TextColumn::make('fase.segment.name')->label('Segment'),
                TextColumn::make('steps_count')->counts('steps')->label('Jumlah Langkah'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('fase')
                    ->relationship('fase', 'name') // DIPERBAIKI: Menggunakan 'name'
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            StepsRelationManager::class, 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMateris::route('/'),
            'create' => Pages\CreateMateri::route('/create'),
            'edit' => Pages\EditMateri::route('/{record}/edit'),
        ];
    }
}