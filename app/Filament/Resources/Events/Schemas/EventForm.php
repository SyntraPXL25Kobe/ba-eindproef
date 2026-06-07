<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Enums\EventStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event details')
                    ->schema([
                        Select::make('company_id')
                            ->relationship('company', 'display_name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('event_type_id')
                            ->relationship('eventType', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(220),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        Select::make('sectors')
                            ->relationship('sectors', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Schedule')
                    ->schema([
                        DateTimePicker::make('start_time')
                            ->required(),
                        DateTimePicker::make('end_time')
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Location')
                    ->schema([
                        Toggle::make('is_online')
                            ->live()
                            ->required(),
                        TextInput::make('online_url')
                            ->url()
                            ->maxLength(255)
                            ->visible(fn ($get): bool => $get('is_online')),
                        Select::make('address_id')
                            ->relationship('address', 'street')
                            ->getOptionLabelFromRecordUsing(fn ($record): string => "{$record->street} {$record->house_number}, {$record->city}")
                            ->searchable()
                            ->preload()
                            ->visible(fn ($get): bool => ! $get('is_online')),
                    ])
                    ->columns(2),

                Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->options(EventStatus::class)
                            ->default('draft')
                            ->required(),
                    ]),
            ]);
    }
}
