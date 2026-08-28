<?php

namespace App\Filament\Note;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapBlock;
use FilamentTiptapEditor\TiptapEditor;

class SpecialNoteBlock extends TiptapBlock
{
    public string $id = 'special_note';
    public ?string $label = 'Special Note';
    public ?string $icon = 'heroicon-o-document-text';
    public string $preview = 'filament.note.special-note-block';
    public string $rendered = 'filament.note.special-note-block';

    public function getModalWidth(): string
    {
        return '5xl'; 
    }

    public function getFormSchema(): array
    {
        return [
            TiptapEditor::make('title')
                ->label('Title (H2 & Warna Teks)')
                ->profile('minimal')
                ->tools(['color', 'heading', 'highlight'])
                ->nullable(),

            TiptapEditor::make('content')
                ->label('Content / Paragraph')
                ->profile('default')
                ->maxContentWidth('5xl')
                ->extraInputAttributes(['style' => 'min-height: 300px;'])
                ->tools([
                    'heading', 'bullet-list', 'ordered-list', 'blockquote', 'code-block',
                    'bold', 'italic', 'underline', 'strike', 'link', 'color', 
                    'media', 
                    'undo', 'redo',
                ])
                ->required(),

            ColorPicker::make('backgroundColor')
                ->label('Background Color')
                ->default('#f1ebff'),

            TextInput::make('padding')
                ->label('Padding (px)')
                ->numeric()
                ->default(16),

            TextInput::make('borderRadius')
                ->label('Border Radius (px)')
                ->numeric()
                ->default(12),
        ];
    }
}