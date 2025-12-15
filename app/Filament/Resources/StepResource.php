<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StepResource\Pages;
use App\Models\Step;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Illuminate\Support\Collection;

class StepResource extends Resource
{
    protected static ?string $model = Step::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';
    protected static ?string $label = 'Langkah Pembelajaran';
    protected static ?string $pluralLabel = 'Langkah Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === Bagian 1: Informasi Dasar ===
                Section::make('Informasi Dasar Langkah')
                    ->schema([
                        Forms\Components\Select::make('materi_id')
                            ->relationship('materi', 'title')
                            ->required()
                            ->label('Parent Materi')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->label('Urutan Langkah')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Judul Langkah')
                            ->columnSpanFull(),
                    ])->columns(2),

                // === Bagian 2: Konten Utama & Video ===
                Section::make('Konten & Media')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->label('Konten Detail Langkah')
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

                        Forms\Components\TextInput::make('video_url')
                            ->label('URL Video (Embed/YouTube Link)')
                            ->helperText('Masukkan URL video (misalnya embed link YouTube atau Vimeo).')
                            ->maxLength(255)
                            ->url()
                            ->columnSpanFull(),
                    ]),
                
                // === Bagian 3: Galeri Gambar ===
                Section::make('Galeri Gambar (Opsional)')
                    ->description('Tambahkan gambar ilustrasi yang akan muncul sebagai slider di halaman detail langkah.')
                    ->schema([
                        Repeater::make('images')
                            ->relationship('images')
                            ->label('Gambar Langkah (Multiple)')
                            ->schema([
                                FileUpload::make('path')
                                    ->label('Upload Gambar')
                                    ->image()
                                    ->directory('steps')
                                    ->disk('public')
                                    ->previewable(true)
                                    ->openable()
                                    ->downloadable()
                                    ->required(),
                            ])
                            ->addActionLabel('Tambah Gambar')
                            ->minItems(0)
                            ->maxItems(10)
                            ->columnSpanFull(),
                    ]),

                // === Bagian 4: Kuis Interaktif (Perbaikan Dinamis Options) ===
                Section::make('Kuis Interaktif')
                    ->description('Atur pertanyaan dan opsi jawaban.')
                    ->collapsible()
                    ->schema([
                        Repeater::make('quiz_data')
                            ->label('Daftar Pertanyaan Kuis')
                            ->schema([
                                Forms\Components\Textarea::make('question')
                                    ->label('Pertanyaan')
                                    ->required()
                                    ->rows(2),
                                
                                // Repeater Options DENGAN .live()
                                Repeater::make('options')
                                    ->label('Opsi Jawaban')
                                    ->live() // Ini adalah KUNCI agar Select di bawahnya diperbarui
                                    ->schema([
                                        TextInput::make('option') 
                                            ->label('Teks Opsi')
                                            ->required(),
                                    ])
                                    ->maxItems(5)
                                    ->minItems(2)
                                    ->collapsible()
                                    ->addActionLabel('Tambah Opsi')
                                    ->afterStateUpdated(function (Forms\Set $set) {
                                        // Opsional: Atur ulang kunci jawaban jika opsi diubah
                                        $set('correct_answer', null);
                                    }),

                                // Select Kunci Jawaban
                                Forms\Components\Select::make('correct_answer')
                                    ->label('Kunci Jawaban yang Benar')
                                    ->required()
                                    ->options(function (Forms\Get $get): array {
                                        // Ambil array dari repeater 'options'
                                        // Catatan: $get harus di-inject ke dalam closure ini
                                        $options = $get('options');
                                        
                                        if (empty($options)) {
                                            return [];
                                        }

                                        // Filter item yang memiliki nilai 'option' (string tidak null)
                                        $validOptions = collect($options)
                                            // Penting: Pastikan $item['option'] ada dan berupa string
                                            ->filter(fn($item) => isset($item['option']) && is_string($item['option']))
                                            ->pluck('option', 'option') 
                                            ->toArray();
                                        
                                        return $validOptions;
                                    })
                                    ->helperText('Pilih teks jawaban yang benar dari opsi di atas.'),

                            ])
                            ->collapsible()
                            ->defaultItems(1)
                            ->addActionLabel('Tambah Pertanyaan')
                            ->columnSpanFull(),
                    ]),
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

                ImageColumn::make('images.0.path')
                    ->label('Gambar')
                    ->disk('public')
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Judul Langkah'),

                Tables\Columns\TextColumn::make('materi.title')
                    ->sortable()
                    ->label('Parent Materi'),
                
                Tables\Columns\TextColumn::make('video_url')
                    ->label('Video')
                    ->default('-'),

                Tables\Columns\TextColumn::make('content')
                    ->html()
                    ->limit(50)
                    ->label('Preview Konten'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('materi')
                    ->relationship('materi', 'title')
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
            'index' => Pages\ListSteps::route('/'),
            'create' => Pages\CreateStep::route('/create'),
            'edit' => Pages\EditStep::route('/{record}/edit'),
        ];
    }
}