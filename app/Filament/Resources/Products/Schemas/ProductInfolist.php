<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                ->vertical()
                ->tabs([
                Tab::make('Product Details')
                     ->icon('heroicon-o-academic-cap')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Name')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('id')
                            ->label('Product ID'),
                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color('success'),
                        TextEntry::make('description')
                            ->label('Description'),
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime('d M Y')
                            ->color('info'),
                    
                    ]),

                Tab::make('Product Price & Stock')  
                    ->badge(fn ($record) => $record->stock)
                    ->icon('heroicon-o-currency-dollar')
                    ->badgeColor(fn ($record) => $record->stock > 10 ? 'success' : 'danger')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                            ->icon('heroicon-o-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('ProductStock')
                            ->icon('heroicon-o-cube'),
                    ]),
            

                Tab::make('Image & Status')
                     ->icon('heroicon-o-photo')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                            ->icon('heroicon-o-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('ProductStock')
                            ->weight('bold')
                            ->color('primary'),
                        IconEntry::make('is_active')
                            ->label('Is Active?')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Is Featured?')
                            ->boolean(),
                    ])
                ])  ->columnSpanFull()
                    ->vertical(),
                // Section::make('product information')
                //     ->schema([
                //         TextEntry::make('name')
                //             ->label('Name')
                //             ->weight('bold')
                //             ->color('primary'),
                //         TextEntry::make('id')
                //             ->label('Product ID'),
                //         TextEntry::make('sku')
                //             ->label('Product SKU')
                //             ->badge()
                //             ->color('success'),
                //         TextEntry::make('description')
                //             ->label('Description'),
                //         TextEntry::make('created_at')
                //             ->label('Created At')
                //             ->dateTime('d M Y')
                //             ->color('info'),
                //     ])->columnSpanFull(),
                // Section::make('price & stock')
                //     ->schema([
                //         TextEntry::make('price')
                //             ->label('Product Price')
                //             ->weight('bold')
                //             ->color('primary')
                //             ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                //             ->icon('heroicon-o-currency-dollar'),
                //         TextEntry::make('stock')
                //             ->label('ProductStock')
                //             ->icon('heroicon-o-cube'),
                //     ])->columnSpanFull(),
                // Section::make('image & status')
                //     ->schema([
                //         ImageEntry::make('image')
                //             ->label('Product Image')
                //             ->disk('public'),
                //         TextEntry::make('price')
                //             ->label('Product Price')
                //             ->weight('bold')
                //             ->color('primary')
                //             ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                //             ->icon('heroicon-o-currency-dollar'),
                //         TextEntry::make('stock')
                //             ->label('ProductStock')
                //             ->weight('bold')
                //             ->color('primary'),
                //         IconEntry::make('is_active')
                //             ->label('Is Active?')
                //             ->boolean(),        
                //     ])->columnSpanFull(),
            ]);
    }
}
