<?php

namespace App\Filament\Resources\Companies;

use App\Enums\CompanyStatus;
use App\Filament\Resources\Companies\Pages\CreateCompany;
use App\Filament\Resources\Companies\Pages\EditCompany;
use App\Filament\Resources\Companies\Pages\ListCompanies;
use App\Filament\Resources\Companies\Pages\ViewCompany;
use App\Filament\Resources\Companies\Schemas\CompanyForm;
use App\Filament\Resources\Companies\Tables\CompaniesTable;
use App\Models\Company;
use BackedEnum;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'display_name';

    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Company details')
                    ->schema([
                        TextEntry::make('display_name'),
                        TextEntry::make('legal_name')->placeholder('—'),
                        TextEntry::make('description')->placeholder('—')->columnSpanFull(),
                        TextEntry::make('sectors.name')->label('Sectors')->badge()->placeholder('—'),
                    ])
                    ->columns(2),

                Section::make('Contact')
                    ->schema([
                        TextEntry::make('email')->label('Email address')->placeholder('—'),
                        TextEntry::make('phone')->placeholder('—'),
                        TextEntry::make('website_url')->label('Website')->placeholder('—'),
                        TextEntry::make('logo_url')->label('Logo URL')->placeholder('—'),
                    ])
                    ->columns(2),

                Section::make('Status')
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (CompanyStatus $state): string => match ($state) {
                                CompanyStatus::APPROVED => 'success',
                                CompanyStatus::PENDING => 'warning',
                                CompanyStatus::REJECTED => 'danger',
                                CompanyStatus::BLOCKED => 'gray',
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return CompaniesTable::configure($table);
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
            'index' => ListCompanies::route('/'),
            'create' => CreateCompany::route('/create'),
            'view' => ViewCompany::route('/{record}'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }
}
