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

// Import komponen Filament yang diperlukan untuk Repeater
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar Materi')
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
                    ])->columns(3),

                // START: PENAMBAHAN REPEATER UNTUK LINK EKSTERNAL
                Forms\Components\Section::make('Sumber Eksternal / Dokumentasi')
                    ->description('Tambahkan link ke sumber daya eksternal (dokumentasi resmi, video, artikel) yang relevan dengan materi ini.')
                    ->schema([
                        Repeater::make('externalLinks')
                            ->relationship() // Menggunakan relasi externalLinks() dari Model Materi
                            ->label('Daftar Link')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Judul Link'),

                                TextInput::make('url')
                                    ->required()
                                    ->url() // Pastikan input adalah URL yang valid
                                    ->maxLength(2048)
                                    ->label('Alamat URL'),

                                Select::make('type')
                                    ->options([
                                        'doc' => 'Dokumentasi Resmi',
                                        'video' => 'Video Tutorial',
                                        'article' => 'Artikel Blog/Web',
                                        'other' => 'Lainnya',
                                    ])
                                    ->default('doc')
                                    ->label('Tipe Sumber')
                                    ->required(),
                            ])
                            ->defaultItems(0) // Mulai tanpa item secara default
                            ->columns(3)
                            ->columnSpanFull()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null) // Label pada item yang sudah diisi
                            ->reorderableWithButtons(), // Memungkinkan pengurutan link
                    ])->collapsible(),
                // END: PENAMBAHAN REPEATER UNTUK LINK EKSTERNAL
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
                // Tambahkan kolom untuk menghitung jumlah link eksternal (opsional)
                Tables\Columns\TextColumn::make('external_links_count')
                    ->counts('externalLinks')
                    ->label('Jumlah Link'),
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