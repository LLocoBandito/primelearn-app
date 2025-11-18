<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaseResource\Pages;
use App\Models\Fase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaseResource extends Resource
{
    protected static ?string $model = Fase::class;

    // Icon yang digunakan di Sidebar
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap'; 
    protected static ?string $navigationGroup = 'Struktur Pembelajaran'; // Kelompokkan dengan Segment dan Materi

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field untuk Foreign Key segment_id (Koneksi ke Segment/Level 1)
                Forms\Components\Select::make('segment_id')
                    ->relationship('segment', 'name') 
                    ->required()
                    ->label('Jalur Pembelajaran (Segment)'),
                    
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Fase'),

                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(1)
                    ->label('Urutan Fase'),
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
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Fase'),

                // Menampilkan nama Segment dari relasi
                Tables\Columns\TextColumn::make('segment.name') 
                    ->sortable()
                    ->label('Jalur Pembelajaran'),

                // Menampilkan jumlah Materi di Fase ini
                Tables\Columns\TextColumn::make('materis_count')
                    ->counts('materis')
                    ->label('Jumlah Materi'),
            ])
            ->filters([
                // Filter data berdasarkan Segment (Jalur Pembelajaran)
                Tables\Filters\SelectFilter::make('segment')
                    ->relationship('segment', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFases::route('/'),
            'create' => Pages\CreateFase::route('/create'),
            'edit' => Pages\EditFase::route('/{record}/edit'),
        ];
    }
}