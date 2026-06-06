<?php

namespace App\Filament\Resources\Companies\Schemas;

use App\Enums\CompanyStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Company details')
                    ->schema([
                        TextInput::make('display_name')
                            ->required()
                            ->maxLength(220),
                        TextInput::make('legal_name')
                            ->maxLength(220),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Contact')
                    ->schema([
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(40),
                        TextInput::make('website_url')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('logo_url')
                            ->label('Logo URL')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->options(CompanyStatus::class)
                            ->default('pending')
                            ->disabled()
                            ->dehydrated(),

                    ]),
            ]);
    }
}
