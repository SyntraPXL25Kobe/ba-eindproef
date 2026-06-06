<div class="space-y-4">
    @forelse ($reviews as $review)
        <div style="border-bottom: 1px solid rgba(255,255,255,0.15); padding-bottom: 1rem;">
            <div class="flex items-center gap-2">
                @php
                    $color = match ($review->status) {
                        \App\Enums\CompanyStatus::APPROVED => 'success',
                        \App\Enums\CompanyStatus::PENDING => 'warning',
                        \App\Enums\CompanyStatus::REJECTED => 'danger',
                        \App\Enums\CompanyStatus::BLOCKED => 'gray',
                    };
                @endphp
                <x-filament::badge :color="$color">
                    {{ ucfirst($review->status->value) }}
                </x-filament::badge>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $review->reviewed_at->format('d M Y, H:i') }} · admin {{ $review->admin_user_id }}
                </span>
            </div>

            @if ($review->notes)
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                    <strong>[Reason]:</strong> {{ $review->notes }}
                </p>
            @endif
        </div>
    @empty
        <p class="text-sm text-gray-500 dark:text-gray-400">No status changes yet.</p>
    @endforelse
</div>