<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Beneficiary;
use App\Exports\BeneficiariesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function excel()
    {
        return Excel::download(new BeneficiariesExport, 'beneficiarios.xlsx');
    }

    public function pdf()
    {
        $beneficiaries = Beneficiary::all();
        $pdf = Pdf::loadView('exports.beneficiaries_pdf', compact('beneficiaries'));
        return $pdf->download('listado_beneficiarios.pdf');
    }
}
