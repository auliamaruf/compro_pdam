<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OnlineComplaintResource\Pages;
use App\Filament\Resources\OnlineComplaintResource\RelationManagers;
use App\Models\OnlineComplaint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OnlineComplaintResource extends Resource
{
    protected static ?string $model = OnlineComplaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationLabel = 'Pengaduan Online';
    protected static ?string $modelLabel = 'Pengaduan Online';
    protected static ?string $pluralModelLabel = 'Pengaduan Online';
    protected static ?string $navigationGroup = 'Komunikasi & Layanan';
    protected static ?int $navigationSort = 2;

       // resource ini disembunyikan
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tiket')
                    ->schema([
                        Forms\Components\TextInput::make('ticket_number')
                            ->label('Nomor Tiket')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->default(fn () => 'TKT-' . strtoupper(uniqid()))
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'pending' => 'Pending',
                                'in_progress' => 'Sedang Diproses',
                                'resolved' => 'Selesai',
                                'closed' => 'Ditutup',
                            ])
                            ->default('pending')
                            ->native(false),
                        Forms\Components\Select::make('priority')
                            ->label('Prioritas')
                            ->required()
                            ->options([
                                'low' => 'Rendah',
                                'medium' => 'Sedang',
                                'high' => 'Tinggi',
                                'urgent' => 'Mendesak',
                            ])
                            ->default('medium')
                            ->native(false),
                        Forms\Components\Select::make('assigned_to')
                            ->label('Ditugaskan ke')
                            ->relationship('assignedUser', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Data Pelanggan')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('customer_id_number')
                            ->label('Nomor ID Pelanggan')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Detail Pengaduan')
                    ->schema([
                        Forms\Components\Select::make('complaint_type')
                            ->label('Jenis Pengaduan')
                            ->required()
                            ->options([
                                'billing' => 'Tagihan',
                                'water_quality' => 'Kualitas Air',
                                'water_pressure' => 'Tekanan Air',
                                'service_connection' => 'Sambungan Baru',
                                'pipe_damage' => 'Kerusakan Pipa',
                                'meter_reading' => 'Pembacaan Meter',
                                'other' => 'Lainnya',
                            ])
                            ->native(false),
                        Forms\Components\TextInput::make('subject')
                            ->label('Subjek Pengaduan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Pengaduan')
                            ->required()
                            ->columnSpanFull()
                            ->rows(4),
                        Forms\Components\FileUpload::make('attachments')
                            ->label('Lampiran')
                            ->multiple()
                            ->directory('complaint-attachments')
                            ->acceptedFileTypes(['image/*', '.pdf', '.doc', '.docx'])
                            ->maxSize(5120) // 5MB
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Respons Admin')
                    ->schema([
                        Forms\Components\Textarea::make('admin_response')
                            ->label('Respons Admin')
                            ->columnSpanFull()
                            ->rows(4),
                        Forms\Components\DateTimePicker::make('responded_at')
                            ->label('Tanggal Respons')
                            ->native(false),
                        Forms\Components\DateTimePicker::make('resolved_at')
                            ->label('Tanggal Selesai')
                            ->native(false),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(),

                Forms\Components\Section::make('Informasi Sistem')
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')
                            ->label('IP Address')
                            ->disabled()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('user_agent')
                            ->label('User Agent')
                            ->disabled()
                            ->rows(2),
                    ])
                    ->columns(1)
                    ->collapsible()
                    ->collapsed(),
            ]);
    }    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ticket_number')
                    ->label('Nomor Tiket')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('complaint_type')
                    ->label('Jenis Pengaduan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'billing' => 'warning',
                        'water_quality' => 'danger',
                        'water_pressure' => 'info',
                        'service_connection' => 'success',
                        'pipe_damage' => 'danger',
                        'meter_reading' => 'gray',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'billing' => 'Tagihan',
                        'water_quality' => 'Kualitas Air',
                        'water_pressure' => 'Tekanan Air',
                        'service_connection' => 'Sambungan Baru',
                        'pipe_damage' => 'Kerusakan Pipa',
                        'meter_reading' => 'Pembacaan Meter',
                        'other' => 'Lainnya',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subjek')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'in_progress',
                        'success' => 'resolved',
                        'secondary' => 'closed',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'in_progress' => 'Diproses',
                        'resolved' => 'Selesai',
                        'closed' => 'Ditutup',
                        default => $state,
                    }),
                Tables\Columns\BadgeColumn::make('priority')
                    ->label('Prioritas')
                    ->colors([
                        'success' => 'low',
                        'warning' => 'medium',
                        'danger' => 'high',
                        'purple' => 'urgent',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'Rendah',
                        'medium' => 'Sedang',
                        'high' => 'Tinggi',
                        'urgent' => 'Mendesak',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('assignedUser.name')
                    ->label('Ditugaskan ke')
                    ->placeholder('Belum ditugaskan')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('responded_at')
                    ->label('Tanggal Respons')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->placeholder('Belum direspons')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('resolved_at')
                    ->label('Tanggal Selesai')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->placeholder('Belum selesai')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('has_attachments')
                    ->label('Lampiran')
                    ->boolean()
                    ->getStateUsing(fn ($record) => !empty($record->attachments))
                    ->trueIcon('heroicon-o-paper-clip')
                    ->falseIcon('heroicon-o-minus'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'Sedang Diproses',
                        'resolved' => 'Selesai',
                        'closed' => 'Ditutup',
                    ])
                    ->multiple(),
                SelectFilter::make('priority')
                    ->label('Prioritas')
                    ->options([
                        'low' => 'Rendah',
                        'medium' => 'Sedang',
                        'high' => 'Tinggi',
                        'urgent' => 'Mendesak',
                    ])
                    ->multiple(),
                SelectFilter::make('complaint_type')
                    ->label('Jenis Pengaduan')
                    ->options([
                        'billing' => 'Tagihan',
                        'water_quality' => 'Kualitas Air',
                        'water_pressure' => 'Tekanan Air',
                        'service_connection' => 'Sambungan Baru',
                        'pipe_damage' => 'Kerusakan Pipa',
                        'meter_reading' => 'Pembacaan Meter',
                        'other' => 'Lainnya',
                    ])
                    ->multiple(),
                Filter::make('unassigned')
                    ->label('Belum Ditugaskan')
                    ->query(fn (Builder $query): Builder => $query->whereNull('assigned_to')),
                Filter::make('unresolved')
                    ->label('Belum Selesai')
                    ->query(fn (Builder $query): Builder => $query->whereNotIn('status', ['resolved', 'closed'])),
                Filter::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Action::make('respond')
                    ->label('Respons')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('primary')
                    ->form([
                        Forms\Components\Textarea::make('admin_response')
                            ->label('Respons Admin')
                            ->required()
                            ->rows(4),
                        Forms\Components\Select::make('status')
                            ->label('Update Status')
                            ->options([
                                'in_progress' => 'Sedang Diproses',
                                'resolved' => 'Selesai',
                                'closed' => 'Ditutup',
                            ])
                            ->default('in_progress')
                            ->native(false),
                    ])
                    ->action(function (OnlineComplaint $record, array $data): void {
                        $record->update([
                            'admin_response' => $data['admin_response'],
                            'status' => $data['status'],
                            'responded_at' => now(),
                            'resolved_at' => $data['status'] === 'resolved' ? now() : null,
                        ]);

                        Notification::make()
                            ->title('Respons berhasil dikirim')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (OnlineComplaint $record): bool => !$record->responded_at),
                Action::make('assign')
                    ->label('Tugaskan')
                    ->icon('heroicon-o-user-plus')
                    ->color('info')
                    ->form([
                        Forms\Components\Select::make('assigned_to')
                            ->label('Tugaskan ke')
                            ->relationship('assignedUser', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->action(function (OnlineComplaint $record, array $data): void {
                        $record->update($data);

                        Notification::make()
                            ->title('Pengaduan berhasil ditugaskan')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_resolved')
                        ->label('Tandai Selesai')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records): void {
                            $records->each(function ($record) {
                                $record->update([
                                    'status' => 'resolved',
                                    'resolved_at' => now(),
                                ]);
                            });

                            Notification::make()
                                ->title('Pengaduan berhasil ditandai selesai')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('Belum ada pengaduan')
            ->emptyStateDescription('Pengaduan online akan muncul di sini setelah pelanggan mengirimkan keluhan.')
            ->emptyStateIcon('heroicon-o-exclamation-triangle');
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
            'index' => Pages\ListOnlineComplaints::route('/'),
            'create' => Pages\CreateOnlineComplaint::route('/create'),
            'edit' => Pages\EditOnlineComplaint::route('/{record}/edit'),
        ];
    }
}
