<?php

namespace App\Http\Controllers;

use App\Enums\CompanyStatus;
use App\Enums\EventStatus;
use App\Models\Company;
use App\Models\Sector;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    public function index(Request $request): Response
    {
        $selectedSector = $request->integer('sector') ?: null;

        $companies = Company::query()
            ->where('status', CompanyStatus::APPROVED)
            ->when($selectedSector, fn ($query) => $query->whereHas(
                'sectors',
                fn ($q) => $q->where('sectors.id', $selectedSector)
            ))
            ->with('sectors:id,name')
            ->orderBy('display_name')
            ->get(['id', 'display_name', 'description', 'logo_url']);

        $sectors = Sector::orderBy('name')->get(['id', 'name']);

        return Inertia::render('companies/index', [
            'companies' => $companies,
            'sectors' => $sectors,
            'selectedSector' => $selectedSector,
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
