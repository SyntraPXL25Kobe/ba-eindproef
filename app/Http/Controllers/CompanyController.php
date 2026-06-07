<?php

namespace App\Http\Controllers;

use App\Enums\CompanyStatus;
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
}
