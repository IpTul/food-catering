<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

use App\Models\Inventory;

class StokBarang extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return Inventory::where('jumlah_barang', '<', 5)->exists();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Inventory::query()
                    ->where('jumlah_barang', '<', 5)
                    ->orderBy('jumlah_barang', 'asc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang')
                    ->label('Nama Barang'),

                Tables\Columns\TextColumn::make('jumlah_barang')
                    ->label('Stok')
                    ->color('danger'),

                Tables\Columns\TextColumn::make('unit_barang')
                    ->label('Unit'),

                Tables\Columns\TextColumn::make('tgl_kadaluwarsa_barang')
                    ->label('Kadaluarsa')
                    ->date(),
            ]);
    }
}
