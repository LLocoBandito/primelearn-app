<?php

namespace App\Filament\Resources\MateriResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class StepsRelationManager extends RelationManager
{
    protected static string $relationship = 'steps';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Judul dan Urutan tetap Wajib (Standar Langkah)
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Judul Langkah'),
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->label('Urutan'),
                    ]),

                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('video_url')
                    ->url()
                    ->columnSpanFull()
                    ->label('URL Video (Opsional)'),

                // --- BAGIAN OPSIONAL (BINTANG MERAH DIHAPUS) ---

                // Foto Opsional
                Forms\Components\Repeater::make('images')
                    ->relationship('images')
                    ->schema([
                        Forms\Components\FileUpload::make('path')
                            ->image()
                            ->directory('steps')
                            ->disk('public'), // Required dihapus
                    ])
                    ->label('Galeri Foto (Opsional)')
                    ->columnSpanFull()
                    ->grid(2),

                // Kuis Opsional
                Forms\Components\Section::make('Kuis Interaktif (Opsional)')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Repeater::make('quiz_data')
                            ->schema([
                                Forms\Components\Textarea::make('question')
                                    ->label('Pertanyaan'), // Required dihapus
                                
                                Forms\Components\Repeater::make('options')
                                    ->schema([
                                        Forms\Components\TextInput::make('option')
                                            ->label('Pilihan Jawaban'), // Required dihapus
                                    ])
                                    ->live() 
                                    ->itemLabel(fn (array $state): ?string => $state['option'] ?? null),

                                Forms\Components\Select::make('correct_answer')
                                    ->label('Jawaban yang Benar')
                                    ->options(function (Forms\Get $get) {
                                        $options = $get('options') ?? [];
                                        return collect($options)
                                            ->filter(fn ($item) => !empty($item['option']))
                                            ->pluck('option', 'option')
                                            ->toArray();
                                    }), // Required dihapus
                            ])
                            ->columnSpanFull(),
                    ]),

                // Link Eksternal Opsional
                Forms\Components\Section::make('Sumber Daya Eksternal (Opsional)')
                    ->schema([
                        Forms\Components\Repeater::make('external_links')
                            ->schema([
                                Forms\Components\TextInput::make('title'), // Required dihapus
                                Forms\Components\TextInput::make('url')->url(), // Required dihapus
                                Forms\Components\TextInput::make('description')->label('Deskripsi Singkat'),
                            ])
                            ->columns(3),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('order')->label('No.')->sortable(),
                Tables\Columns\TextColumn::make('title')->label('Langkah')->searchable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}