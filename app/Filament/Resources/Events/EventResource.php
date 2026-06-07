<?php

namespace App\Filament\Resources\Events;

use App\Enums\EventStatus;
use App\Filament\Resources\Events\Pages\CreateEvent;
use App\Filament\Resources\Events\Pages\EditEvent;
use App\Filament\Resources\Events\Pages\ListEvents;
use App\Filament\Resources\Events\Pages\ViewEvent;
use App\Filament\Resources\Events\Schemas\EventForm;
use App\Filament\Resources\Events\Tables\EventsTable;
use App\Models\Event;
use BackedEnum;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return EventForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event details')
                    ->schema([
                        TextEntry::make('company.display_name')->label('Company'),
                        TextEntry::make('eventType.name')->label('Event type'),
                        TextEntry::make('title'),
                        TextEntry::make('description')->placeholder('—')->columnSpanFull(),
                        TextEntry::make('sectors.name')->label('Sectors')->badge()->placeholder('—'),
                    ])
                    ->columns(2),

                Section::make('Schedule')
                    ->schema([
                        TextEntry::make('start_time')->dateTime(),
                        TextEntry::make('end_time')->dateTime(),
                    ])
                    ->columns(2),

                Section::make('Location')
                    ->schema([
                        IconEntry::make('is_online')->boolean(),
                        TextEntry::make('online_url')->placeholder('—'),
                        TextEntry::make('address.city')
                            ->label('Address')
                            ->formatStateUsing(fn ($record): string => $record->address ? "{$record->address->street} {$record->address->house_number}, {$record->address->city}" : '—'),
                    ])
                    ->columns(2),

                Section::make('Status')
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (EventStatus $state): string => match ($state) {
                                EventStatus::PUBLISHED => 'success',
                                EventStatus::DRAFT => 'gray',
                                EventStatus::CANCELLED => 'danger',
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return EventsTable::configure($table);
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
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
            'edit' => EditEvent::route('/{record}/edit'),
            'view' => ViewEvent::route('/{record}'),
        ];
    }
}
