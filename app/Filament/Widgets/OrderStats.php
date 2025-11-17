<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;

use App\Models\Order;
use App\Models\Recipe;
use App\Models\Inventory;
use Illuminate\Support\Carbon;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Product', Recipe::count())
                ->description('Total Product')
                ->descriptionIcon('heroicon-m-archive-box', IconPosition::Before)
                // ->chart([1, 3, 5, 10, 20, 40])
                ->color('info'),
            Stat::make('Total Barang', Inventory::count())
                ->description('Total Barang')
                ->descriptionIcon('heroicon-m-archive-box', IconPosition::Before)
                ->color('warning'),
            Stat::make('Total Orders', Order::count())
                ->description('Total orders')
                ->descriptionIcon('heroicon-m-users', IconPosition::Before)
                ->color('danger'),
            Stat::make('New Order Today', Order::whereDate('created_at', today())->count())
                ->description('Orders placed today')
                ->descriptionIcon('heroicon-m-plus', IconPosition::Before)
                ->color('success'),
        ];
    }
}
