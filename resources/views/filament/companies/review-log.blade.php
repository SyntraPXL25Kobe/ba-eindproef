<div>
    @forelse ($reviews as $review)
        <p>{{ $review->reviewed_at }} — admin {{ $review->admin_user_id }} — {{ $review->status->value }} — {{ $review->notes }}</p>
    @empty
        <p>No status changes yet.</p>
    @endforelse
</div>
