<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SegmentResource\Pages;
use App\Models\Segment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;

class SegmentResource extends Resource
{
    protected static ?string $model = Segment::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Segment/Jalur Pembelajaran')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Jalur')
                    ->rows(3),

                FileUpload::make('image_path')
                    ->label('Segment Image')
                    ->directory('segments')     // folder penyimpanan: storage/app/public/segments
                    ->image()                  // hanya gambar
                    ->imagePreviewHeight('150')
                    ->required(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Gambar') 
                    ->disk('public')
                    ->height(50)
                    ->width(50),

                Tables\Columns\TextColumn::make('name')
                    ->label('Segment')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi Singkat')
                    ->limit(50),

                Tables\Columns\TextColumn::make('fases_count')
                    ->label('Jumlah Fase')
                    ->counts('fases'),
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
            'create' => Pages\CreateSegment::route('/create'),
            'edit' => Pages\EditSegment::route('/{record}/edit'),
        ];
    }
}
