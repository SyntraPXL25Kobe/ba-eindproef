<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Actions\ReviewCompanyAction;
use App\Enums\CompanyStatus;
use App\Filament\Resources\Companies\CompanyResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\View\View;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewLog')
                ->label('View log')
                ->icon(Heroicon::OutlinedClock)
                ->color('gray')
                ->modalHeading('Status change log')
                ->modalWidth('lg')
                ->modalContent(fn (): View => view(
                    'filament.companies.review-log',
                    ['reviews' => $this->record->reviews()->latest('reviewed_at')->get()],
                ))
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Close'),
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

        if ($company->status === $status) {
            Notification::make()
                ->title('No change')
                ->body("{$company->display_name} is already {$status->value}.")
                ->warning()
                ->send();

            return;
        }

        app(ReviewCompanyAction::class)->execute($company, $status, auth()->user(), $notes);

        $this->refreshFormData(['status']);

        $notification = Notification::make()
            ->title('Company status updated')
            ->body("{$company->display_name} is now {$status->value}.");

        match ($status) {
            CompanyStatus::APPROVED => $notification->icon(Heroicon::OutlinedCheckCircle)->success(),
            CompanyStatus::REJECTED => $notification->icon(Heroicon::OutlinedXCircle)->danger(),
            CompanyStatus::BLOCKED => $notification->icon(Heroicon::OutlinedNoSymbol)->color('gray'),
            default => $notification->info(),
        };

        $notification->send();
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->url($this->getResource()::getUrl('view', ['record' => $this->record]));
    }
}
