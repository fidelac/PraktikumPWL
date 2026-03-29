<?php

namespace App\Filament\Resources\Posts\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;
use Illuminate\Support\Facades\Date;
use Laravel\Pail\File;
use Tiptap\Core\Mark;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //Section 1
                Section::make('Post Details') //Mengelompokkan field dalam sebuah section
                    ->Description('Fill in the details of the post') //Deskripsi untuk section
                    ->Icon(Heroicon::DocumentText) //Menambahkan ikon pada section
                    ->schema([
                    Group::make([
                        TextInput::make('title')
                            ->required()
                            ->rules(['min:5', 'max:255'])
                            ->validationMessages([
                                'required' => 'The title field is required.',
                                'min' => 'The title must be at least :5 characters.',
                            ]),
                        TextInput::make('slug')
                            ->required()
                            ->rules(['min:3', 'max:255'])
                            ->unique()
                            ->validationMessages([
                                'unique' => 'The slug must be unique.',
                                'min' => 'The slug must be at least :3 characters.',
                            ]),
                        Select::make('category_id')
                            ->required()
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable(),
                        ColorPicker::make('color'),
                    ])->columns(2), //Mengatur lebar section menjadi 2 kolom
                        RichEditor::make('body'),
                    ])->columnSpan(2), 
                    
                //Grouping fields into 2 columns
                Group::make([
                    //Section 2
                    Section::make('Image Upload')
                        ->Description('Upload an image for the post')
                        ->Icon(Heroicon::Photo)
                        ->schema([
                            FileUpload::make('image')
                                ->required()
                                ->validationMessages([
                                    'required' => 'The image field is required.',
                                ])
                                ->disk('public')
                                ->directory("post"),
                        ]),

                    //Section 3
                    Section::make('Additional Information')
                        ->Description('Additional information about the post')
                        ->Icon(Heroicon::InformationCircle)
                        ->schema([
                            TagsInput::make('tags'),
                            Checkbox::make('published'),
                            DateTimePicker::make('published_at'),
                        ])
                ])->columnSpan(1),
                //
            ])->columns(3);
    }
}
