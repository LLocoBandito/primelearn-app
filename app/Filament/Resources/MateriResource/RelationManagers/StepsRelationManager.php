<?php

namespace App\Filament\Resources\MateriResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

// Import komponen tambahan yang diperlukan
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Grid;


class StepsRelationManager extends RelationManager
{
    protected static string $relationship = 'steps';
    protected static ?string $title = 'Langkah-Langkah Pembelajaran';
    protected static ?string $label = 'Langkah';
    protected static ?string $pluralLabel = 'Langkah-Langkah';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. INFORMASI DASAR (Grid 3 Kolom)
                Section::make('Informasi Dasar Langkah')
                    ->description('Urutan, judul, dan pengaturan interaktivitas.')
                    ->schema([
                        TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->label('Urutan Langkah'),

                        Toggle::make('is_interactive')
                            ->label('Langkah Interaktif?')
                            ->hint('Aktifkan jika langkah ini mengandung kuis atau akordeon interaktif.')
                            ->default(false),

                        // Tambahkan video_url jika ada di Model Step
                        TextInput::make('video_url')
                            ->url()
                            ->label('URL Video Embed (YouTube/Vimeo)')
                            ->helperText('Masukkan URL embed video (misalnya: iframe src dari YouTube).')
                            ->columnSpanFull(),
                    ])->columns(3),

                // 2. KONTEN UTAMA
                Section::make('Konten Detail Langkah')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Judul Langkah')
                            ->columnSpanFull(), 

                        RichEditor::make('content')
                            ->required()
                            ->label('Konten Langkah')
                            ->fileAttachmentsDisk('public') 
                            ->fileAttachmentsDirectory('steps-attachments')
                            ->toolbarButtons([ 
                                'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock', 
                                'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 
                                'strike', 'underline', 'undo',
                            ])
                            ->extraAttributes([
                                'style' => 'min-height: 40vh;', 
                            ])
                            ->columnSpanFull(),
                    ]),
                
                // 3. GAMBAR PENDUKUNG (Repeater untuk Multiple Images)
                // Ini menggantikan TextInput::make('image_path')
                Section::make('Gambar Pendukung')
                    ->description('Tambahkan gambar yang akan ditampilkan dalam slider/galeri di langkah ini.')
                    ->collapsible()
                    ->schema([
                        Repeater::make('images')
                            ->relationship('images') // Relasi ke StepImage::class (asumsi Anda punya)
                            ->label('Daftar Gambar')
                            ->schema([
                                FileUpload::make('image_path')
                                    ->required()
                                    ->image()
                                    ->disk('public')
                                    ->directory('step-images')
                                    ->visibility('public')
                                    ->label('File Gambar')
                                    ->columnSpan(2),
                                
                                TextInput::make('alt_text')
                                    ->label('Teks Alternatif (SEO/Aksesibilitas)')
                                    ->nullable(),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->deleteAction(
                                fn (Forms\Components\Actions\Action $action) => $action->icon('heroicon-o-trash')
                            )
                            ->reorderableWithButtons(),
                    ])->columnSpanFull(),

                // 4. DATA KUIS (Untuk Interaktif)
                Section::make('Data Kuis (Jika Interaktif)')
                    ->description('Struktur data JSON/Array untuk kuis interaktif.')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Textarea::make('quiz_data')
                            ->label('Struktur Kuis JSON/Array')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

            ]);
    }
    
    // ... table() method tetap sama ...

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->label('No.')
                    ->width(50),
                    
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Judul Langkah'),

                // Menampilkan status interaktif
                Tables\Columns\IconColumn::make('is_interactive')
                    ->label('Interaktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('content')
                    ->html() 
                    ->limit(50)
                    ->label('Preview Konten'),

                // Kolom hitungan gambar (Perlu eager loading count di MateriResource)
                Tables\Columns\TextColumn::make('images_count')
                    ->counts('images')
                    ->label('Jml. Gambar'),
            ])
            ->filters([
                // Tambahkan filter interaktif
                Tables\Filters\TernaryFilter::make('is_interactive')
                    ->label('Hanya Langkah Interaktif'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}