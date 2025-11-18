<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;

use App\Models\Order;
use App\Models\Recipe;
use App\Models\Inventory;
use Illuminate\Support\Carbon;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = [
            Stat::make('Total Product', Recipe::count())
                ->description('Total Product')
                ->descriptionIcon('heroicon-m-archive-box', IconPosition::Before)
                ->color('info'),

            Stat::make('Total Barang', Inventory::count())
                ->description('Total Barang')
                ->descriptionIcon('heroicon-m-archive-box', IconPosition::Before)
                ->color('warning'),

            Stat::make('Total Orders', Order::count())
                ->description('Total orders')
                ->descriptionIcon('heroicon-m-users', IconPosition::Before)
                ->color('info'),

            Stat::make('New Order Today', Order::whereDate('created_at', today())->count())
                ->description('Orders placed today')
                ->descriptionIcon('heroicon-m-plus', IconPosition::Before)
                ->color('success'),
        ];

        // Cek stok hampir habis
        $lowStockCount = Inventory::where('jumlah_barang', '<', 5)->count();

        // Jika ada barang yang stoknya < 5, baru tampilkan Stat
        if ($lowStockCount > 0) {
            $stats[] = Stat::make('Stok Barang Hampir Habis', $lowStockCount)
                ->description('Barang dengan stok dibawah 5')
                ->descriptionIcon('heroicon-m-exclamation-triangle', IconPosition::Before)
                ->color('danger');
        }

        return $stats;
    }
}