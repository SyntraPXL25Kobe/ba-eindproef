<?php

namespace App\Filament\Resources\Events\Tables;

use App\Enums\EventStatus;
use App\Filament\Resources\Events\EventResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn ($record): string => EventResource::getUrl('view', ['record' => $record]))
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
                    ->color(fn (EventStatus $state): string => match ($state) {
                        EventStatus::PUBLISHED => 'success',
                        EventStatus::DRAFT => 'gray',
                        EventStatus::CANCELLED => 'danger',
                    })
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
                SelectFilter::make('status')
                    ->options(EventStatus::class),
                Filter::make('now')
                    ->label('Happening now')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('status', EventStatus::PUBLISHED)
                        ->where('start_time', '<=', now())
                        ->where('end_time', '>=', now())),
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
