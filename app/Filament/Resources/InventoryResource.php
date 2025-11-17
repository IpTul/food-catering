<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_barang')
                ->label("Nama Barang")
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('jumlah_barang')
                ->label("Jumlah")
                ->required()
                ->numeric()
                ->maxLength(255),
                Forms\Components\TextInput::make('unit_barang')
                ->label("Satuan Unit")
                ->required()
                ->helperText('contoh: 10 kg, 5 liter, 3 botol')
                ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi_barang')
                ->label("Deskripsi")
                ->nullable()
                ->maxLength(65535),
                Forms\Components\DatePicker::make('tgl_pemasukan_barang')
                ->label("Tanggal Masuk")
                ->required(),
                Forms\Components\DatePicker::make('tgl_kadaluwarsa_barang')
                ->label("Tanggal Kadaluwarsa")
                ->required()
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('nama_barang')->searchable(),
                Tables\Columns\TextColumn::make('jumlah_barang'),
                Tables\Columns\TextColumn::make('deskripsi_barang'),
                Tables\Columns\TextColumn::make('tgl_pemasukan_barang'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}
