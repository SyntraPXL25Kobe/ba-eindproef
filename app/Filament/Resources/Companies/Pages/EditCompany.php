<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Actions\ReviewCompanyAction;
use App\Enums\CompanyStatus;
use App\Filament\Resources\Companies\CompanyResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->label('Approve')
                ->icon(Heroicon::OutlinedCheckCircle)
                ->color('success')
                ->requiresConfirmation()
                ->action(fn () => $this->review(CompanyStatus::APPROVED)),

            Action::make('reject')
                ->label('Reject')
                ->icon(Heroicon::OutlinedXCircle)
                ->color('danger')
                ->schema([
                    Textarea::make('notes')
                        ->label('Reason')
                        ->required(),
                ])
                ->action(fn (array $data) => $this->review(CompanyStatus::REJECTED, $data['notes'])),

            Action::make('block')
                ->label('Block')
                ->icon(Heroicon::OutlinedNoSymbol)
                ->color('gray')
                ->schema([
                    Textarea::make('notes')
                        ->label('Reason')
                        ->required(),
                ])
                ->action(fn (array $data) => $this->review(CompanyStatus::BLOCKED, $data['notes'])),

            DeleteAction::make(),
        ];
    }

    protected function review(CompanyStatus $status, ?string $notes = null): void
    {
        $company = $this->record;

        app(ReviewCompanyAction::class)->execute($company, $status, auth()->user(), $notes);

        $this->refreshFormData(['status']);
    }
}
