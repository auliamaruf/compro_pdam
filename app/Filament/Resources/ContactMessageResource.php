<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Pesan Kontak';
    protected static ?string $modelLabel = 'Pesan Kontak';
    protected static ?string $pluralModelLabel = 'Pesan Kontak';
    protected static ?string $navigationGroup = 'Komunikasi & Layanan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pesan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('phone')
                                    ->label('Telepon')
                                    ->tel()
                                    ->maxLength(20),
                                Select::make('type')
                                    ->label('Jenis Pesan')
                                    ->options([
                                        'general' => 'Umum',
                                        'complaint' => 'Keluhan',
                                        'suggestion' => 'Saran',
                                        'service_info' => 'Info Layanan',
                                        'technical_support' => 'Bantuan Teknis',
                                    ])
                                    ->required(),
                            ]),
                        TextInput::make('subject')
                            ->label('Subjek')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('message')
                            ->label('Pesan')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Status & Tindak Lanjut')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_read')
                                    ->label('Sudah Dibaca'),
                                Toggle::make('is_resolved')
                                    ->label('Sudah Diselesaikan'),
                            ]),
                        DateTimePicker::make('resolved_at')
                            ->label('Waktu Penyelesaian')
                            ->visible(fn (callable $get) => $get('is_resolved')),
                        Textarea::make('admin_notes')
                            ->label('Catatan Admin')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('subject')
                    ->label('Subjek')
                    ->searchable()
                    ->limit(50),
                BadgeColumn::make('type_display')
                    ->label('Jenis')
                    ->colors([
                        'gray' => 'Umum',
                        'danger' => 'Keluhan',
                        'success' => 'Saran',
                        'primary' => 'Info Layanan',
                        'warning' => 'Bantuan Teknis',
                    ]),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Dibaca')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_resolved')
                    ->label('Diselesaikan')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->label('Jenis Pesan')
                    ->options([
                        'general' => 'Umum',
                        'complaint' => 'Keluhan',
                        'suggestion' => 'Saran',
                        'service_info' => 'Info Layanan',
                        'technical_support' => 'Bantuan Teknis',
                    ]),
                SelectFilter::make('is_read')
                    ->label('Status Baca')
                    ->options([
                        1 => 'Sudah Dibaca',
                        0 => 'Belum Dibaca',
                    ]),
                SelectFilter::make('is_resolved')
                    ->label('Status Penyelesaian')
                    ->options([
                        1 => 'Sudah Diselesaikan',
                        0 => 'Belum Diselesaikan',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_read')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->action(fn (ContactMessage $record) => $record->markAsRead())
                    ->visible(fn (ContactMessage $record) => !$record->is_read),
                Tables\Actions\Action::make('mark_resolved')
                    ->label('Tandai Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->form([
                        Textarea::make('admin_notes')
                            ->label('Catatan Penyelesaian')
                            ->rows(3),
                    ])
                    ->action(function (ContactMessage $record, array $data) {
                        $record->markAsResolved($data['admin_notes'] ?? null);
                    })
                    ->visible(fn (ContactMessage $record) => !$record->is_resolved),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_read')
                        ->label('Tandai Dibaca')
                        ->icon('heroicon-o-eye')
                        ->action(fn ($records) => $records->each->markAsRead()),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::unread()->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::unread()->count() > 0 ? 'warning' : 'success';
    }
}
