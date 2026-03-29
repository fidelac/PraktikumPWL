<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product info')
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

                    ])->columnSpanFull(),

                Section::make('Product Price & Stock')
                    ->description('')
                    
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
                    ])
                    ->columnSpanFull(),

                Section::make('Image & Status')
                    ->description('')
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
                    ->columnSpanFull(),
            ]);
    }
}
