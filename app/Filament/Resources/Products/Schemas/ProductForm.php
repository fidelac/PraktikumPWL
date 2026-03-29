<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Action;
use Laravel\Pail\File;
use Tiptap\Core\Mark;
use Filament\Support\Icons\Heroicon;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product info')
                        ->description('Isi Informasi Produk')
                        ->icon(Heroicon::InformationCircle)
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->required()
                            ])->columns(2),
                            MarkdownEditor::make('description')
                                ->required(),
                        ]),
                    Step::make('Pricing & Stock')
                        ->description('Isi Harga dan Stok Produk')
                        ->icon(Heroicon::CurrencyDollar)
                        ->schema([
                            Group::make([
                                TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->rules(['min:0']),
                                TextInput::make('stock')
                                    ->numeric()
                                    ->required()
                            ])
                        ]),

                    Step::make('Media & Status')
                        ->description('Upload Gambar dan Atur Status Produk')
                        ->icon(Heroicon::Photo)
                        ->schema([
                            // Add media and status components here
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory("products"),
                            Checkbox::make('is_active')
                                ->label('Active'),
                            Checkbox::make('is_featured')
                                ->label('Featured'),
                        ])

                ])
                    ->columnSpanFull()
                    ->submitAction(
                        Action::make('Save')
                            ->label('Save Product')
                            ->button()
                            ->color('primary')
                            ->submit('save')
                    )
            ]);
    }
}
