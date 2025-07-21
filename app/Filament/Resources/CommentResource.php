<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Komentar';

    protected static ?string $modelLabel = 'Komentar';

    protected static ?string $pluralModelLabel = 'Komentar';

    protected static ?string $navigationGroup = 'Komunikasi & Layanan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Komentar')
                    ->schema([
                        Forms\Components\Select::make('commentable_type')
                            ->label('Tipe Konten')
                            ->required()
                            ->options([
                                'App\\Models\\News' => 'Berita',
                                'App\\Models\\Service' => 'Layanan',
                                'App\\Models\\Page' => 'Halaman',
                            ])
                            ->reactive(),
                        Forms\Components\Select::make('commentable_id')
                            ->label('Konten')
                            ->required()
                            ->options(function (callable $get) {
                                $type = $get('commentable_type');
                                if (!$type) return [];
                                
                                return $type::pluck('title', 'id')->toArray();
                            })
                            ->searchable(),
                        Forms\Components\Select::make('parent_id')
                            ->label('Balasan dari')
                            ->relationship('parent', 'content')
                            ->searchable()
                            ->placeholder('Pilih jika ini adalah balasan'),
                    ])->columns(2),

                Forms\Components\Section::make('Data Pengirim')
                    ->schema([
                        Forms\Components\TextInput::make('author_name')
                            ->label('Nama Pengirim')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('author_email')
                            ->label('Email Pengirim')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('author_phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(255),
                    ])->columns(3),

                Forms\Components\Section::make('Konten Komentar')
                    ->schema([
                        Forms\Components\Textarea::make('content')
                            ->label('Isi Komentar')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'pending' => 'Menunggu Persetujuan',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'spam' => 'Spam',
                            ])
                            ->default('pending'),
                        Forms\Components\DateTimePicker::make('approved_at')
                            ->label('Waktu Persetujuan'),
                        Forms\Components\KeyValue::make('meta')
                            ->label('Metadata Tambahan')
                            ->keyLabel('Kunci')
                            ->valueLabel('Nilai'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('commentable_type')
                    ->label('Tipe Konten')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'App\\Models\\News' => 'Berita',
                        'App\\Models\\Service' => 'Layanan',
                        'App\\Models\\Page' => 'Halaman',
                        default => $state
                    })
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'App\\Models\\News' => 'success',
                        'App\\Models\\Service' => 'warning',
                        'App\\Models\\Page' => 'info',
                        default => 'gray'
                    }),
                Tables\Columns\TextColumn::make('commentable.title')
                    ->label('Konten')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('author_name')
                    ->label('Nama Pengirim')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Komentar')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'gray' => 'spam',
                    ])
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'spam' => 'Spam',
                        default => $state
                    }),
                Tables\Columns\TextColumn::make('parent.author_name')
                    ->label('Balasan untuk')
                    ->placeholder('Komentar utama')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('approved_at')
                    ->label('Disetujui')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Belum disetujui'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu Persetujuan',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'spam' => 'Spam',
                    ]),
                Tables\Filters\SelectFilter::make('commentable_type')
                    ->label('Tipe Konten')
                    ->options([
                        'App\\Models\\News' => 'Berita',
                        'App\\Models\\Service' => 'Layanan',
                        'App\\Models\\Page' => 'Halaman',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (Comment $record) => $record->update([
                        'status' => 'approved',
                        'approved_at' => now(),
                    ]))
                    ->visible(fn (Comment $record): bool => $record->status === 'pending'),
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-m-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (Comment $record) => $record->update(['status' => 'rejected']))
                    ->visible(fn (Comment $record): bool => $record->status === 'pending'),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('approve')
                        ->label('Setujui yang Dipilih')
                        ->icon('heroicon-m-check')
                        ->color('success')
                        ->action(fn (Collection $records) => $records->each->update([
                            'status' => 'approved',
                            'approved_at' => now(),
                        ])),
                    Tables\Actions\BulkAction::make('reject')
                        ->label('Tolak yang Dipilih')
                        ->icon('heroicon-m-x-mark')
                        ->color('danger')
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'rejected'])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
