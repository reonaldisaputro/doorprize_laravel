<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Peserta;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PesertaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PesertaResource\RelationManagers;
use Filament\Tables\Columns\IconColumn;

class PesertaResource extends Resource
{
    protected static ?string $model = Peserta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('merchant')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('titik_kumpul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor_bus')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kode_peserta')
                    ->required()
                    ->maxLength(255),
                // Checkbox untuk validasi
                // Checkbox::make('is_valid')
                //     ->label('Validasi Peserta')
                //     ->helperText('Tandai peserta sebagai valid untuk ikut undian.')
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('kode_peserta')->sortable()->searchable(),
                // Status validasi peserta
                IconColumn::make('is_valid')
                    ->boolean()
                    ->label('Valid'),
                TextColumn::make('merchant')->sortable()->searchable(),
                TextColumn::make('titik_kumpul')->sortable()->searchable(),
                TextColumn::make('nomor_bus')->sortable()->searchable(),
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
            'index' => Pages\ListPesertas::route('/'),
            'create' => Pages\CreatePeserta::route('/create'),
            'edit' => Pages\EditPeserta::route('/{record}/edit'),
        ];
    }
}
