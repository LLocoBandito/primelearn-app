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

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form->schema([

            // SELECT SEGMENT
            Forms\Components\Select::make('segment_id')
                ->relationship('segment', 'name')
                ->required()
                ->label('Jalur Pembelajaran (Segment)'),


            // INPUT NAME
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nama Fase'),

            // INPUT ORDER
            Forms\Components\TextInput::make('order')
                ->numeric()
                ->default(1)
                ->label('Urutan Fase'),

            // FILE UPLOAD GAMBAR
            Forms\Components\FileUpload::make('featured_image')
                ->image()
                ->directory('fase-images')
                ->imageEditor()
                ->openable()
                ->downloadable()
                ->label('Featured Image')
                ->columnSpanFull(),
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

                Tables\Columns\TextColumn::make('segment.name')
                    ->sortable()
                    ->label('Jalur Pembelajaran'),

                // JUMLAH MATERI
                Tables\Columns\TextColumn::make('materis_count')
                    ->counts('materis')
                    ->label('Jumlah Materi'),

                // PREVIEW GAMBAR
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->size(60),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('segment')
                    ->relationship('segment', 'name')
                    ->label('Filter Segment'),
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
            'index'  => Pages\ListFases::route('/'),
            'create' => Pages\CreateFase::route('/create'),
            'edit'   => Pages\EditFase::route('/{record}/edit'),
        ];
    }
}
