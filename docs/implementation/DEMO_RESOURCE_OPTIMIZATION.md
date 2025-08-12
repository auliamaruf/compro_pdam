# Demo Implementation: OnlineComplaintResource Optimization

Berikut adalah implementasi optimasi untuk `OnlineComplaintResource` yang dapat Anda terapkan:

```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Kolom tiket & pelanggan
            Tables\Columns\TextColumn::make('ticket_customer')
                ->label('Tiket & Pelanggan')
                ->html()
                ->formatStateUsing(function ($record) {
                    return "<div class='space-y-1'>
                        <div class='font-mono text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded inline-block'>
                            {$record->ticket_number}
                        </div>
                        <div class='font-medium'>{$record->customer_name}</div>
                        <div class='text-sm text-gray-600'>{$record->phone}</div>
                    </div>";
                })
                ->searchable(['ticket_number', 'customer_name', 'phone'])
                ->sortable(),

            // Kolom pengaduan
            Tables\Columns\TextColumn::make('complaint_details')
                ->label('Detail Pengaduan')
                ->html()
                ->formatStateUsing(function ($record) {
                    $type = match($record->complaint_type) {
                        'billing' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Tagihan</span>',
                        'water_quality' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Kualitas Air</span>',
                        'water_pressure' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Tekanan Air</span>',
                        'service_connection' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Sambungan</span>',
                        'pipe_damage' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Kerusakan Pipa</span>',
                        default => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Lainnya</span>',
                    };
                    
                    return "<div class='space-y-1'>
                        <div>{$type}</div>
                        <div class='text-sm font-medium'>" . Str::limit($record->subject, 40) . "</div>
                    </div>";
                }),

            // Kolom status & prioritas
            Tables\Columns\TextColumn::make('status_priority')
                ->label('Status & Prioritas')
                ->html()
                ->formatStateUsing(function ($record) {
                    $status = match($record->status) {
                        'pending' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>',
                        'in_progress' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Diproses</span>',
                        'resolved' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Selesai</span>',
                        'closed' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Ditutup</span>',
                    };
                    
                    $priority = match($record->priority) {
                        'low' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Rendah</span>',
                        'medium' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Sedang</span>',
                        'high' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">Tinggi</span>',
                        'urgent' => '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Mendesak</span>',
                    };
                    
                    return "<div class='space-y-1'>
                        <div>{$status}</div>
                        <div>{$priority}</div>
                    </div>";
                }),

            // Kolom assigned & created (toggleable)
            Tables\Columns\TextColumn::make('management_info')
                ->label('Pengelolaan')
                ->html()
                ->formatStateUsing(function ($record) {
                    $assigned = $record->assignedUser 
                        ? "<div class='text-sm'><strong>PIC:</strong> {$record->assignedUser->name}</div>"
                        : "<div class='text-sm text-gray-400'>Belum ditugaskan</div>";
                    
                    $created = "<div class='text-sm'><strong>Dibuat:</strong> {$record->created_at->format('d M Y')}</div>";
                    
                    return "<div class='space-y-1'>{$assigned}{$created}</div>";
                })
                ->toggleable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'in_progress' => 'Sedang Diproses',
                    'resolved' => 'Selesai',
                    'closed' => 'Ditutup',
                ]),
            Tables\Filters\SelectFilter::make('priority')
                ->label('Prioritas')
                ->options([
                    'low' => 'Rendah',
                    'medium' => 'Sedang',
                    'high' => 'Tinggi',
                    'urgent' => 'Mendesak',
                ]),
            Tables\Filters\SelectFilter::make('complaint_type')
                ->label('Jenis Pengaduan')
                ->options([
                    'billing' => 'Tagihan',
                    'water_quality' => 'Kualitas Air',
                    'water_pressure' => 'Tekanan Air',
                    'service_connection' => 'Sambungan Baru',
                    'pipe_damage' => 'Kerusakan Pipa',
                    'meter_reading' => 'Pembacaan Meter',
                    'other' => 'Lainnya',
                ]),
        ])
        ->actions([
            Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('assign')
                    ->label('Tugaskan')
                    ->icon('heroicon-o-user-plus')
                    ->form([
                        Forms\Components\Select::make('assigned_to')
                            ->label('Tugaskan ke')
                            ->relationship('assignedUser', 'name')
                            ->required(),
                    ])
                    ->action(function (array $data, $record) {
                        $record->update(['assigned_to' => $data['assigned_to']]);
                        Notification::make()
                            ->title('Berhasil ditugaskan')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('change_status')
                    ->label('Ubah Status')
                    ->icon('heroicon-o-arrow-path')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Status Baru')
                            ->options([
                                'pending' => 'Pending',
                                'in_progress' => 'Sedang Diproses',
                                'resolved' => 'Selesai',
                                'closed' => 'Ditutup',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, $record) {
                        $record->update(['status' => $data['status']]);
                        Notification::make()
                            ->title('Status berhasil diubah')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->label('Aksi')
            ->icon('heroicon-m-ellipsis-vertical')
            ->size('sm')
            ->color('gray')
            ->button()
        ])
        ->defaultSort('created_at', 'desc');
}
```

## Implementasi Untuk Resource Lainnya

### UserResource
```php
Tables\Columns\TextColumn::make('user_info')
    ->label('Informasi User')
    ->html()
    ->formatStateUsing(function ($record) {
        $verified = $record->email_verified_at 
            ? '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">✓ Verified</span>'
            : '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">✗ Unverified</span>';
        
        return "<div class='space-y-1'>
            <div class='font-medium'>{$record->name}</div>
            <div class='text-sm text-gray-600'>{$record->email}</div>
            <div>{$verified}</div>
        </div>";
    })
    ->searchable(['name', 'email'])
    ->sortable(),
```

### ContactMessageResource
```php
Tables\Columns\TextColumn::make('contact_info')
    ->label('Kontak')
    ->html()
    ->formatStateUsing(function ($record) {
        return "<div class='space-y-1'>
            <div class='font-medium'>{$record->name}</div>
            <div class='text-sm text-gray-600'>{$record->email}</div>
            <div class='text-sm'>{$record->phone}</div>
        </div>";
    }),

Tables\Columns\TextColumn::make('message_info')
    ->label('Pesan')
    ->html()
    ->formatStateUsing(function ($record) {
        $subject = Str::limit($record->subject, 40);
        $message = Str::limit($record->message, 60);
        
        return "<div class='space-y-1'>
            <div class='font-medium'>{$subject}</div>
            <div class='text-sm text-gray-600'>{$message}</div>
        </div>";
    }),
```

### ServiceResource
```php
Tables\Columns\TextColumn::make('service_info')
    ->label('Layanan')
    ->html()
    ->formatStateUsing(function ($record) {
        $status = $record->is_active 
            ? '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Aktif</span>'
            : '<span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Nonaktif</span>';
        
        return "<div class='space-y-1'>
            <div class='font-medium'>{$record->name}</div>
            <div class='text-sm text-gray-600'>" . Str::limit($record->description, 50) . "</div>
            <div>{$status}</div>
        </div>";
    }),
```

Implementasi ini akan memberikan:
1. **Efisiensi ruang** - Mengurangi kolom dari 6+ menjadi 3-4 kolom
2. **Informasi terstruktur** - Data terkait digabung dalam satu kolom
3. **Visual hierarchy** - Menggunakan badge, warna, dan typography
4. **Action grouping** - Semua action dalam satu dropdown
5. **Responsive design** - Toggleable columns untuk fleksibilitas
