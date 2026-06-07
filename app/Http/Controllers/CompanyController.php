<?php

namespace App\Http\Controllers;

use App\Enums\CompanyStatus;
use App\Enums\EventStatus;
use App\Models\Company;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    public function index(): Response
    {
        $companies = Company::query()
            ->where('status', CompanyStatus::APPROVED)
            ->with('sectors:id,name')
            ->orderBy('display_name')
            ->get(['id', 'display_name', 'description', 'logo_url']);

        return Inertia::render('companies/index', [
            'companies' => $companies,
        ]);
    }

    public function show(Company $company): Response
    {
        $company->load([
            'sectors:id,name',
            'events' => fn ($query) => $query
                ->where('status', EventStatus::PUBLISHED)
                ->orderBy('start_time')
                ->select('id', 'company_id', 'title', 'description', 'start_time', 'end_time', 'is_online'),
        ]);

        return Inertia::render('companies/show', [
            'company' => $company,
        ]);
    }
}
