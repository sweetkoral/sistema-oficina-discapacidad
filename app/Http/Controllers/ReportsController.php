<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Exports\BeneficiariesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generate(Request $request)
    {
        $format = $request->input('format', 'pdf');
        $query = Beneficiary::query();

        // Optional filters could be added here
        if ($request->filled('disability_type')) {
            $query->where('disability_type', $request->disability_type);
        }

        if ($format === 'excel') {
            return Excel::download(new BeneficiariesExport($query), 'reporte_beneficiarios.xlsx');
        }

        $beneficiaries = $query->get();
        $pdf = Pdf::loadView('exports.beneficiaries_pdf', compact('beneficiaries'));
        return $pdf->download('reporte_beneficiarios.pdf');
    }
}
