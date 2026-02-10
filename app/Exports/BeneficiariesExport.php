<?php

namespace App\Exports;

use App\Models\Beneficiary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BeneficiariesExport implements FromCollection, WithHeadings
{
    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }

    public function collection()
    {
        if ($this->query) {
            return $this->query->select('full_name', 'rut', 'contact', 'email', 'commune', 'profile_type', 'disability_type', 'age_range', 'gender', 'territory')->get();
        }
        return Beneficiary::select('full_name', 'rut', 'contact', 'email', 'commune', 'profile_type', 'disability_type', 'age_range', 'gender', 'territory')->get();
    }

    public function headings(): array
    {
        return [
            'Nombre Completo',
            'RUT',
            'Contacto',
            'Email',
            'Comuna',
            'Perfil',
            'Tipo Discapacidad',
            'Rango Etario',
            'Sexo',
            'Territorio',
        ];
    }
}
