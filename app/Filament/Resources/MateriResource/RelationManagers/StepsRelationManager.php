<?php
namespace App\Filament\Resources\MateriResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
// Import semua komponen yang dibutuhkan
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;

class StepsRelationManager extends RelationManager
{
    protected static string $relationship = 'steps';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Salin Skema dari StepResource ke sini
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
                    ->columnSpanFull(),

                // Repeater Galeri Gambar
                Forms\Components\Repeater::make('images')
                    ->relationship('images')
                    ->schema([
                        Forms\Components\FileUpload::make('path')
                            ->image()
                            ->directory('steps')
                            ->disk('public')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->grid(2),

                // Repeater Kuis
                Forms\Components\Section::make('Kuis Interaktif')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Repeater::make('quiz_data')
                            ->schema([
                                Forms\Components\Textarea::make('question')->required(),
                                Forms\Components\Repeater::make('options')
                                    ->schema([
                                        Forms\Components\TextInput::make('option')->required(),
                                    ])->live(),
                                Forms\Components\Select::make('correct_answer')
                                    ->options(function (Forms\Get $get) {
                                        $options = $get('options');
                                        return collect($options)->pluck('option', 'option')->toArray();
                                    })->required(),
                            ])->columnSpanFull(),
                    ]),

                // Repeater External Links (DENGAN DESKRIPSI)
                Forms\Components\Section::make('Sumber Daya Eksternal')
                    ->schema([
                        Forms\Components\Repeater::make('external_links')
                            ->schema([
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\TextInput::make('url')->url()->required(),
                                Forms\Components\TextInput::make('description')->label('Deskripsi Singkat'),
                            ])->columns(3),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('order')->label('No.'),
                Tables\Columns\TextColumn::make('title')->label('Langkah'),
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