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
    protected static ?string $title = 'Langkah-Langkah Pembelajaran';
    protected static ?string $label = 'Langkah';
    protected static ?string $pluralLabel = 'Langkah-Langkah';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }

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
                    
                Tables\Columns\TextColumn::make('content')
                    ->html() 
                    ->limit(50)
                    ->label('Preview Konten'),
            ])
            ->filters([
                //
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