<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kategori;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Imports\KategoriImport;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KategoriResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KategoriResource\RelationManagers;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label("nominal(dalam angka tanpa titik dan rupiah)")
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('nama')
                    ->label('Nominal')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return 'Nominal Rp ' . number_format($state, 0, ',', '.');
                    })->searchable(),
                TextColumn::make('created_at')->label('Tanggal Ditambahkan')->dateTime(),
                ViewColumn::make('notes')
                    ->view('filament.kategori-notes'),
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


                // Action::make('import')
                //     ->label('Import Excel')
                //     ->icon('heroicon-o-rectangle-stack')
                //     ->form([
                //         Forms\Components\FileUpload::make('file')
                //             ->required()
                //             ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                //     ])
                //     ->action(function (array $data) {
                //         Excel::import(new KategoriImport, $data['file']);
                //     }),

                /// INI IMPORT YG BENER
                // Action::make('resetAndImport')
                //     ->label('Reset dan Import Excel')
                //     ->color('danger') // Warna merah untuk menunjukkan tindakan berbahaya
                //     ->icon('heroicon-o-trash')
                //     ->requiresConfirmation()
                //     ->modalHeading('Peringatan: Reset Kategori')
                //     ->modalDescription('Jika Anda melanjutkan, semua kategori dan subkategori terkait akan dihapus. Data ini tidak dapat dikembalikan. Yakin ingin melanjutkan?')
                //     ->modalSubmitActionLabel('Ya, Hapus dan Import')
                //     ->form([
                //         Forms\Components\FileUpload::make('file')
                //             ->required()
                //             ->label('Pilih File Excel')
                //             ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                //             ->directory('kategori')
                //             ->disk('public'),
                //     ])
                //     ->action(function (array $data) {
                //         // Hapus semua data kategori dan subkategori yang terkait
                //         // Subkategori::query()->delete();
                //         Kategori::query()->delete();

                //         // Import file Excel yang baru
                //         Excel::import(new KategoriImport, Storage::disk('public')->path($data['file']));

                //         Notification::make()
                //             ->title('Data Kategori dan Subkategori Telah Direset dan Diimport')
                //             ->success()
                //             ->send();
                //     }),


                // Action::make('import')
                //     ->label('Import Excel')
                //     ->icon('heroicon-o-rectangle-stack')
                //     ->form([
                //         Forms\Components\FileUpload::make('file')
                //             ->disk('public')  // Simpan file di disk 'public'
                //             ->directory('kategori-excel')  // Simpan file di folder 'peserta' dalam disk 'public'
                //             ->required()  // Membuat input file wajib
                //             ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']) // Khusus file Excel (.xlsx)

                //     ])
                //     ->action(function (array $data) {
                //         try {
                //             $path = $data['file'];
                //             if (Storage::disk('public')->exists($path)) {
                //                 Excel::import(new KategoriImport, Storage::disk('public')->path($path));
                //                 Notification::make()
                //                     ->title('Import berhasil')
                //                     ->body('Data peserta berhasil diimport.')
                //                     ->success()
                //                     ->send();
                //             } else {
                //                 Notification::make()
                //                     ->title('File tidak ditemukan')
                //                     ->body('File yang diunggah tidak dapat ditemukan. Coba ulangi.')
                //                     ->danger()
                //                     ->send();
                //             }
                //         } catch (\Exception $e) {

                //             \Illuminate\Support\Facades\Log::error('Error during import: ' . $e->getMessage());
                //             Notification::make()
                //                 ->title('Import gagal')
                //                 ->body('Terjadi kesalahan: ' . $e->getMessage())
                //                 ->danger()
                //                 ->send();
                //         }
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
            'index' => Pages\ListKategoris::route('/'),
            'create' => Pages\CreateKategori::route('/create'),
            'edit' => Pages\EditKategori::route('/{record}/edit'),
        ];
    }
}
