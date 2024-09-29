<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Subkategori;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubkategoriResource\Pages;
use App\Filament\Resources\SubkategoriResource\RelationManagers;

class SubkategoriResource extends Resource
{
    protected static ?string $model = Subkategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kategori_id')
                    ->relationship('kategori', 'nama')
                    ->required(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori.nama')->label('Kategori')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('qty')->sortable(),
                TextColumn::make('created_at')->label('Tanggal Ditambahkan')->dateTime(),
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
            'index' => Pages\ListSubkategoris::route('/'),
            'create' => Pages\CreateSubkategori::route('/create'),
            'edit' => Pages\EditSubkategori::route('/{record}/edit'),
        ];
    }
}
