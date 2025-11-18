<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SegmentResource\Pages;
use App\Models\Segment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SegmentResource extends Resource
{
    protected static ?string $model = Segment::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field ini digunakan saat membuat data baru (Create) dan mengedit data lama (Edit)
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Segment/Jalur Pembelajaran'),
                
                Forms\Components\Textarea::make('description')
                    ->rows(3)
                    ->label('Deskripsi Jalur'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Segment'),
                
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->label('Deskripsi Singkat'),
                
                // Menghitung jumlah Fase yang terhubung
                Tables\Columns\TextColumn::make('fases_count')
                    ->counts('fases') 
                    ->label('Jumlah Fase'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSegments::route('/'),
            // 'create' mengarah ke form yang didefinisikan di method form() untuk membuat entri baru
            'create' => Pages\CreateSegment::route('/create'), 
            'edit' => Pages\EditSegment::route('/{record}/edit'),
        ];
    }
}