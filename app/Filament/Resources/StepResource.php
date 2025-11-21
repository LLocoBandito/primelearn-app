<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StepResource\Pages;
use App\Models\Step;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StepResource extends Resource
{
    protected static ?string $model = Step::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationGroup = 'Struktur Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('materi_id')
                    ->relationship('materi', 'title') 
                    ->required()
                    ->label('Parent Materi'),

                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Urutan Langkah'),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Langkah')
                    ->columnSpanFull(), 

                // Menggunakan extraAttributes untuk kompatibilitas versi lama
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
                        'style' => 'min-height: 40vh;', // Mengatur tinggi editor
                    ])
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('image_path')
                    ->label('Image Path (Opsional)'),
            ])->columns(2); 
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
                    ->label('Judul Langkah'),
                
                Tables\Columns\TextColumn::make('materi.title')
                    ->sortable()
                    ->label('Parent Materi'),
                
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