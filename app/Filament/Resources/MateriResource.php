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

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('fase_id')
                    ->relationship('fase', 'name') // Foreign Key ke Fase
                    ->required()
                    ->label('Parent Fase'),
                
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Materi'),
                
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(1)
                    ->label('Urutan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->label('No.')
                    ->width(50),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Materi'),
                // Menampilkan nama Fase dari relasi
                Tables\Columns\TextColumn::make('fase.name')
                    ->sortable()
                    ->label('Fase'),
                // Menampilkan Segment melalui relasi berlapis (fase.segment)
                Tables\Columns\TextColumn::make('fase.segment.name')
                    ->sortable()
                    ->label('Segment'),
                // Menghitung jumlah Steps
                Tables\Columns\TextColumn::make('steps_count')
                    ->counts('steps')
                    ->label('Jumlah Langkah'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('fase')
                    ->relationship('fase', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        // PENTING: Menghubungkan Materi ke Langkah-Langkah (Steps)
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