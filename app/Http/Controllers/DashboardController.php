<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBeneficiaries = Beneficiary::count();
        $disabilityTypesCount = Beneficiary::distinct('disability_type')->count();
        $recentBeneficiaries = Beneficiary::latest()->take(5)->get();

        // Group by disability for a small summary
        $statsByType = Beneficiary::select('disability_type', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('disability_type')
            ->get();

        return view('dashboard', compact('totalBeneficiaries', 'disabilityTypesCount', 'recentBeneficiaries', 'statsByType'));
    }
}
