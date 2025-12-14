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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Grid;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str; 

class StepResource extends Resource
{
    protected static ?string $model = Step::class;
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';
    protected static ?string $label = 'Langkah Materi';
    protected static ?string $pluralLabel = 'Langkah Materi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['lg' => 3])
                    ->schema([
                        Section::make('Informasi Dasar Langkah')->columnSpan(['lg' => 1])
                            ->description('Tentukan materi induk, urutan, dan pengaturan interaktivitas.')
                            ->schema([
                                Forms\Components\Select::make('materi_id')
                                    ->relationship('materi', 'title')
                                    ->required()
                                    ->label('Parent Materi')
                                    ->searchable()
                                    ->preload()
                                    ->live() // Diperlukan untuk memperbarui 'order'
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        // Secara otomatis mengisi order dengan Max Order + 1
                                        if ($state) {
                                            $nextOrder = Step::where('materi_id', $state)->max('order') + 1;
                                            $set('order', $nextOrder);
                                        }
                                    }),
                                    
                                Forms\Components\TextInput::make('order')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->label('Urutan Langkah')
                                    ->helperText('Angka urutan. Diisi otomatis jika Parent Materi diubah.'),
                                    
                                Forms\Components\Toggle::make('is_interactive')
                                    ->label('Langkah Interaktif?')
                                    ->default(false)
                                    ->helperText('Aktifkan jika konten ini mengandung kuis atau akordeon interaktif.'),
                                    
                                // !!! KOLOM total_steps DIHAPUS DARI SINI !!!
                            ]),

                        Section::make('Konten & Gambar Langkah')->columnSpan(['lg' => 2])
                            ->description('Tulis konten utama langkah dan tambahkan gambar pendukung (Slider).')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Judul Langkah')
                                    ->columnSpanFull(),
                                Forms\Components\Placeholder::make('interactive_guidance')
                                    ->content('Gunakan tombol **Source Code (</>)** untuk memasukkan tag kustom (Kotak Info, Akordeon) tanpa dibungkus paragraf.')
                                    ->columnSpanFull()
                                    ->extraAttributes(['class' => 'p-3 rounded-lg bg-yellow-50 border border-yellow-300']),
                                
                                Forms\Components\RichEditor::make('content')
                                    ->required()
                                    ->label('Konten Detail Langkah')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('steps-attachments')
                                    ->toolbarButtons(['attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'underline', 'undo', 'sourceCode'])
                                    ->extraAttributes(['style' => 'min-height: 40vh;'])
                                    ->columnSpanFull(),

                                Repeater::make('images')
                                    ->relationship('images')
                                    ->label('Gambar Langkah (Slider)')
                                    ->schema([
                                        FileUpload::make('image_path')
                                            ->label('Upload Gambar')
                                            ->image()
                                            ->directory('steps')
                                            ->disk('public')
                                            ->required(),
                                    ])
                                    ->addActionLabel('Tambah Gambar')
                                    ->minItems(0)
                                    ->maxItems(10)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Video Penjelasan (Opsional)')
                    ->description('Paste URL Embed YouTube (misalnya: https://www.youtube.com/embed/abc123).')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('video_url')
                            ->url()
                            ->placeholder('https://www.youtube.com/embed/...')
                            ->label('URL Embed YouTube')
                            ->columnSpanFull(),
                    ])->columnSpanFull(),

                // === Kuis Interaktif Terstruktur ===
                Section::make('Kuis Interaktif (Opsional)')
                    ->description('Buat kuis pilihan ganda. Anda dapat menambahkan beberapa pertanyaan, masing-masing dengan opsi jawabannya.')
                    ->collapsible()
                    ->schema([
                        Repeater::make('quiz_data')
                            ->label('Daftar Pertanyaan Kuis')
                            ->schema([
                                Forms\Components\TextInput::make('question')
                                    ->label('Pertanyaan Kuis')
                                    ->placeholder('Contoh: Apa buah berwarna merah?')
                                    ->required()
                                    ->columnSpanFull(),

                                Repeater::make('options')
                                    ->label('Pilihan Jawaban')
                                    ->schema([
                                        Forms\Components\TextInput::make('option')
                                            ->label('Teks Jawaban')
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->addActionLabel('Tambah Pilihan')
                                    ->defaultItems(3)
                                    ->minItems(2)
                                    ->maxItems(6)
                                    ->live()
                                    ->columnSpan(2),

                                Forms\Components\Select::make('correct_option')
                                    ->label('Jawaban Benar (Pilih Teks Jawaban)')
                                    ->options(function (Get $get) {
                                        $options = $get('options') ?? []; 
                                        
                                        if (empty($options)) {
                                            return [];
                                        }
                                        
                                        return collect($options)->mapWithKeys(function($item, $key) {
                                            $index = (int) $key; 
                                            $optionText = $item['option'] ?? "Pilihan Kosong " . ($index + 1);
                                            // Simpan indeks (0, 1, 2, ...) sebagai nilai yang benar
                                            return [$index => $optionText]; 
                                        })->toArray();
                                    })
                                    ->required()
                                    ->helperText('Nilai yang disimpan adalah indeks (0, 1, 2, ...) dari pilihan di sebelah kiri.')
                                    ->columnSpan(1)
                                    ->reactive(),
                            ])
                            ->columns(3)
                            ->addActionLabel('Tambah Pertanyaan Kuis')
                            ->minItems(1)
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')->sortable()->label('No.')->width(50),
                Tables\Columns\IconColumn::make('is_interactive')->label('Int.')->boolean(),
                ImageColumn::make('images.0.image_path')->label('Gambar')->disk('public')->size(60),
                Tables\Columns\TextColumn::make('title')->searchable()->label('Judul Langkah')->limit(40),
                Tables\Columns\TextColumn::make('materi.title')->sortable()->label('Parent Materi')->limit(20),
                Tables\Columns\TextColumn::make('content')->html()->limit(30)->label('Preview Konten'),
                Tables\Columns\TextColumn::make('video_url')
                    ->label('Video')
                    ->formatStateUsing(fn ($state) => $state ? '✅' : '❌')->size('sm'),
                
                // Logika untuk menghitung jumlah pertanyaan kuis
                Tables\Columns\TextColumn::make('quiz_data')
                    ->label('Kuis (Jml)')
                    ->formatStateUsing(function ($state) {
                        // Jika Model casting berhasil (direkomendasikan)
                        if (is_array($state)) {
                            return count($state) > 0 ? count($state) : '❌';
                        }
                        // Fallback manual decode
                        if (is_string($state)) {
                            $decoded = json_decode($state, true);
                            if (is_array($decoded)) {
                                return count($decoded) > 0 ? count($decoded) : '❌';
                            }
                        }
                        return '❌';
                    })
                    ->size('sm'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('materi')->relationship('materi', 'title'),
                Tables\Filters\TernaryFilter::make('is_interactive')->label('Hanya Interaktif')->nullable(),
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