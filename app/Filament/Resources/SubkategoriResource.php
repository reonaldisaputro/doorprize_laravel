<?php

namespace App\Filament\Resources;

use App\Exports\SubkategoriExport;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Subkategori;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubkategoriResource\Pages;
use App\Filament\Resources\SubkategoriResource\RelationManagers;
use App\Imports\SubkategoriImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Action;

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
                FileUpload::make('image')
                    ->label('image')
                    ->disk('public')
                    ->directory('subkategori'),
                FileUpload::make('image_title')
                    ->label('Image Title')
                    ->disk('public')
                    ->directory('subkategori_title'),
                // ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori.nama')->label('Kategori')->sortable()->formatStateUsing(function ($state) {
                    return 'Nominal Rp ' . number_format($state, 0, ',', '.');
                })->searchable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('qty')->sortable(),
                ImageColumn::make('image')
                    ->label('Gambar'),
                ImageColumn::make('image_title')
                    ->label('Gambar Title'),
                TextColumn::make('created_at')->label('Tanggal Ditambahkan')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                // Action::make('export')
                //     ->label('Export Excel')
                //     ->icon('heroicon-o-rectangle-stack')
                //     ->action(fn() => Excel::download(new SubkategoriExport, 'peserta.xlsx')),

                // Action::make('import')
                //     ->label('Import Excel')
                //     ->icon('heroicon-o-rectangle-stack')
                //     ->form([
                //         Forms\Components\FileUpload::make('file')
                //             ->required()
                //             ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                //     ])
                //     ->action(function (array $data) {
                //         Excel::import(new SubkategoriImport, $data['file']);
                //     }),
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
