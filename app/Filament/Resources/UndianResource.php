<?php

namespace App\Filament\Resources;

use App\Exports\UndianExport;
use Filament\Forms;
use Filament\Tables;
use App\Models\Undian;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UndianResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UndianResource\RelationManagers;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Action;

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
                // Forms\Components\Select::make('peserta_id')
                //     ->relationship('peserta', 'is_valid')
                //     ->label('Status Validasi')
                //     ->options([
                //         0 => 'Tidak Valid',  // Nilai 0 untuk "Tidak Valid"
                //         1 => 'Valid',        // Nilai 1 untuk "Valid"
                //     ])
                //     ->default(0)  // Nilai default jika diperlukan
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subkategori.nama')->label('Subkategori')->sortable(),
                TextColumn::make('peserta.nama')->label('Nama Peserta')->sortable()->searchable(),
                TextColumn::make('peserta.kode_peserta')->label('Kode Peserta')->sortable()->searchable(),
                IconColumn::make('peserta.is_valid') // Update to reflect peserta's is_valid
                    ->boolean()
                    ->label('Valid'),
                TextColumn::make('peserta.merchant')->label('Merchant')->sortable()->searchable(),
                TextColumn::make('peserta.titik_kumpul')->label('Titik Kumpul')->sortable()->searchable(),
                TextColumn::make('peserta.nomor_bus')->label('Nomor Bus')->sortable()->searchable(),
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
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-rectangle-stack')
                    ->action(fn() => Excel::download(new UndianExport, 'undian.xlsx')),
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
