<?php

namespace App\Filament\Resources;

use App\Models\Ingredient;
use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
// use App\Filament\Resources\RecipeResource\RelationManagers\TutorialsRelationManager;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('stok')
                ->options(['tersedia' => 'tersedia', 'habis' => 'habis'])
                ->required(),
                Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('Recipe/Thumbnail')
                ->preserveFilenames()
                ->required(),
                Forms\Components\TextInput::make('mn_hd_nasi')
                ->label('Menu Hidangan Nasi')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('mn_hd_utama')
                ->label('Menu Hidangan Utama')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('mn_hd_pelengkap')
                ->label('Menu Hidangan Pelengkap')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('mn_hd_sayur')
                ->label('Menu Hidangan Sayur')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('mn_hd_minuman')
                ->label('Menu Hidangan Minuman')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('mn_hd_penutup')
                ->label('Menu Hidangan Penutup')
                ->required()
                ->maxLength(255),
                Forms\Components\Textarea::make('about')
                ->required()
                ->rows(10)
                ->cols(20),
                Forms\Components\TextInput::make('price')
                ->required()
                ->maxLength(255),
                Forms\Components\Repeater::make('recipeIngredients')
                ->relationship()
                ->schema([
                    Forms\Components\Select::make('ingredient_id')
                    ->relationship('ingredient', 'name')
                    ->required()
                ]),
                Forms\Components\Repeater::make('photos')
                ->relationship('photos')
                ->schema([
                    Forms\Components\FileUpload::make('photo')
                    ->disk('public')
                    ->directory('Recipe/Photo')
                    ->required(),
                ]),
                Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                ->searchable(),
                Tables\Columns\TextColumn::make('price')
                ->searchable(),
                Tables\Columns\TextColumn::make('stok')
                ->searchable(),
                ImageColumn::make('thumbnail')
                ->circular(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                ->label('Category')
                ->relationship('category', 'name'),
                SelectFilter::make('ingredient_id')
                ->label('Ingredient')
                ->options(Ingredient::pluck('name', 'id')->toArray())
                ->query(function(Builder $query, array $data) {
                    if (!empty($data['value'])) {
                        $query->whereHas('recipeIngredients', function ($query) use ($data) {
                            $query->where('ingredient_id', $data['value']);
                        });
                    }
                }),
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
            // TutorialsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
