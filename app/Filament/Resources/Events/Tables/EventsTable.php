<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.display_name')
                    ->label('Company')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('eventType.name')
                    ->label('Event type')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('title')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('is_online')
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('online_url')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('address.city')
                    ->label('Address')
                    ->formatStateUsing(fn ($record): string => $record->address ? "{$record->address->street} {$record->address->house_number}, {$record->address->city}" : '—')
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
