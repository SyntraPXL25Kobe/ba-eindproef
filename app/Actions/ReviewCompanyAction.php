<?php

namespace App\Actions;

use App\Enums\CompanyStatus;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReviewCompanyAction
{
    public function execute(Company $company, CompanyStatus $status, User $admin, ?string $notes = null): CompanyReview
    {
        return DB::transaction(function () use ($company, $status, $admin, $notes): CompanyReview {
            $company->update(['status' => $status]);

            return $company->reviews()->create([
                'admin_user_id' => $admin->id,
                'status' => $status,
                'notes' => $notes,
                'reviewed_at' => now(),
            ]);
        });
    }
}
