<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Undian;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UndianResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UndianResource\RelationManagers;

class UndianResource extends Resource
{
    protected static ?string $model = Undian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('subkategori_id')
                    ->relationship('subkategori', 'nama')
                    ->required(),
                Forms\Components\Select::make('peserta_id')
                    ->relationship('peserta', 'nama')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subkategori.nama')->label('Subkategori')->sortable(),
                TextColumn::make('peserta.nama')->label('Nama Peserta')->sortable(),
                TextColumn::make('peserta.kode_peserta')->label('Kode Peserta')->sortable(),
                TextColumn::make('peserta.merchant')->label('Merchant')->sortable(),
                TextColumn::make('peserta.titik_kumpul')->label('Titik Kumpul')->sortable(),
                TextColumn::make('peserta.nomor_bus')->label('Nomor Bus')->sortable(),
                TextColumn::make('created_at')->label('Tanggal Undian')->dateTime(),
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
            'index' => Pages\ListUndians::route('/'),
            'create' => Pages\CreateUndian::route('/create'),
            'edit' => Pages\EditUndian::route('/{record}/edit'),
        ];
    }
}
