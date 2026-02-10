<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use App\Helpers\ChileHelper;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        $query = Beneficiary::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('rut', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('commune')) {
            $query->where('commune', $request->commune);
        }

        if ($request->filled('disability_type')) {
            $query->where('disability_type', $request->disability_type);
        }

        $beneficiaries = $query->latest()->get();
        $communes = ChileHelper::getCommunes();

        return view('beneficiaries.index', compact('beneficiaries', 'communes'));
    }

    public function create()
    {
        $communes = ChileHelper::getCommunes();
        return view('beneficiaries.create', compact('communes'));
    }

    public function store(Request $request)
    {
        if (!ChileHelper::validateRut($request->rut)) {
            return back()->withErrors(['rut' => 'El RUT ingresado no es válido.'])->withInput();
        }

        $data = $request->validate([
            'full_name' => 'required|min:3',
            'rut' => 'required|unique:beneficiaries',
            'contact' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'email' => 'nullable|email',
            'commune' => 'required',
            'profile_type' => 'required',
            'disability_type' => 'required',
            'age_range' => 'nullable',
            'gender' => 'nullable',
            'territory' => 'nullable',
            'observations' => 'nullable',
        ], [
            'full_name.required' => 'El nombre es obligatorio.',
            'contact.regex' => 'El formato del teléfono no es válido.',
        ]);

        Beneficiary::create($data);

        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiario registrado correctamente.');
    }

    public function show(Beneficiary $beneficiary)
    {
        return view('beneficiaries.show', compact('beneficiary'));
    }

    public function edit(Beneficiary $beneficiary)
    {
        $communes = ChileHelper::getCommunes();
        return view('beneficiaries.edit', compact('beneficiary', 'communes'));
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        if (!ChileHelper::validateRut($request->rut)) {
            return back()->withErrors(['rut' => 'El RUT ingresado no es válido.'])->withInput();
        }

        $data = $request->validate([
            'full_name' => 'required|min:3',
            'rut' => 'required|unique:beneficiaries,rut,' . $beneficiary->id,
            'contact' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'email' => 'nullable|email',
            'commune' => 'required',
            'profile_type' => 'required',
            'disability_type' => 'required',
            'age_range' => 'nullable',
            'gender' => 'nullable',
            'territory' => 'nullable',
            'observations' => 'nullable',
        ]);

        $beneficiary->update($data);

        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiario actualizado correctamente.');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();
        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiario eliminado correctamente.');
    }
}
