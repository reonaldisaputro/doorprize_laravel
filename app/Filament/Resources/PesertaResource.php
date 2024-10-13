<?php

namespace App\Filament\Resources;

use App\Exports\PesertaExport;
use App\Imports\PesertaImport;
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
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

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
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('resetPeserta')
                    ->label('Hapus Semua Peserta dan Data Terkait')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->action(function () {
                        // Hapus semua data di tabel 'undians' terlebih dahulu
                        \App\Models\Undian::query()->delete();

                        // Kemudian hapus data di tabel 'pesertas'
                        \App\Models\Peserta::query()->delete();

                        Notification::make()
                            ->title('Semua Data Peserta dan Undian Terkait Telah Dihapus')
                            ->success()
                            ->send();
                    }),

                Action::make('resetAndImport')
                    ->label('Reset dan Import Excel')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->required()
                            ->label('Pilih File Excel')
                            ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->directory('peserta')
                            ->disk('public'),
                    ])
                    ->action(function (array $data) {
                        // Hapus semua data peserta
                        Peserta::query()->delete();

                        // Import file Excel yang baru
                        Excel::import(new PesertaImport, Storage::disk('public')->path($data['file']));

                        Notification::make()
                            ->title('Data Peserta Telah Direset dan Diimport')
                            ->success()
                            ->send();
                    }),
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-rectangle-stack')
                    ->action(fn() => Excel::download(new PesertaExport, 'peserta.xlsx')),

                Action::make('import')
                    ->label('Import Excel')
                    ->icon('heroicon-o-rectangle-stack')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->disk('public')  // Simpan file di disk 'public'
                            ->directory('peserta-excel')  // Simpan file di folder 'peserta' dalam disk 'public'
                            ->required()  // Membuat input file wajib
                            ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']) // Khusus file Excel (.xlsx)

                    ])
                    ->action(function (array $data) {
                        try {
                            $path = $data['file'];
                            if (Storage::disk('public')->exists($path)) {
                                Excel::import(new PesertaImport, Storage::disk('public')->path($path));
                                Notification::make()
                                    ->title('Import berhasil')
                                    ->body('Data peserta berhasil diimport.')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('File tidak ditemukan')
                                    ->body('File yang diunggah tidak dapat ditemukan. Coba ulangi.')
                                    ->danger()
                                    ->send();
                            }
                        } catch (\Exception $e) {

                            \Illuminate\Support\Facades\Log::error('Error during import: ' . $e->getMessage());
                            Notification::make()
                                ->title('Import gagal')
                                ->body('Terjadi kesalahan: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),


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
