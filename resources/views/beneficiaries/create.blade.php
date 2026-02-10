@extends('layouts.institutional')

@section('content')
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-base font-bold">Ficha de usuario</h2>
                <p class="text-xs text-gray-500">Registro nuevo • Datos básicos + clasificación + observaciones</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('beneficiaries.index') }}"
                    class="px-4 py-2 border border-gray-200 rounded-xl text-sm hover:bg-gray-50 text-gray-600">Volver</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('beneficiaries.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Nombre completo</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Ej: Ana Pérez"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">RUT</label>
                    <input type="text" name="rut" value="{{ old('rut') }}" placeholder="12.345.678-9"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Contacto</label>
                    <input type="text" name="contact" value="{{ old('contact') }}" placeholder="+56 9 XXXX XXXX"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Correo (opcional)</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.cl"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Comuna</label>
                    <select name="commune"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                        <option value="">Seleccione una comuna</option>
                        @foreach($communes as $commune)
                            <option value="{{ $commune }}" {{ old('commune') == $commune ? 'selected' : '' }}>{{ $commune }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Perfil</label>
                    <select name="profile_type"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                        <option value="Beneficiario/a" {{ old('profile_type') == 'Beneficiario/a' ? 'selected' : '' }}>
                            Beneficiario/a</option>
                        <option value="Cuidador/a" {{ old('profile_type') == 'Cuidador/a' ? 'selected' : '' }}>Cuidador/a
                        </option>
                        <option value="Funcionario/a" {{ old('profile_type') == 'Funcionario/a' ? 'selected' : '' }}>
                            Funcionario/a</option>
                        <option value="Consulta" {{ old('profile_type') == 'Consulta' ? 'selected' : '' }}>Consulta</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Tipo de discapacidad</label>
                    <select name="disability_type"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                        <option value="Física" {{ old('disability_type') == 'Física' ? 'selected' : '' }}>Física</option>
                        <option value="Sensorial" {{ old('disability_type') == 'Sensorial' ? 'selected' : '' }}>Sensorial
                        </option>
                        <option value="Intelectual" {{ old('disability_type') == 'Intelectual' ? 'selected' : '' }}>
                            Intelectual</option>
                        <option value="Psíquica" {{ old('disability_type') == 'Psíquica' ? 'selected' : '' }}>Psíquica
                        </option>
                        <option value="Múltiple" {{ old('disability_type') == 'Múltiple' ? 'selected' : '' }}>Múltiple
                        </option>
                        <option value="Otras" {{ old('disability_type') == 'Otras' ? 'selected' : '' }}>Otras</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Rango etario</label>
                    <select name="age_range"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                        <option value="0–17" {{ old('age_range') == '0–17' ? 'selected' : '' }}>0–17</option>
                        <option value="18–29" {{ old('age_range') == '18–29' ? 'selected' : '' }}>18–29</option>
                        <option value="30–44" {{ old('age_range') == '30–44' ? 'selected' : '' }}>30–44</option>
                        <option value="45–59" {{ old('age_range') == '45–59' ? 'selected' : '' }}>45–59</option>
                        <option value="60+" {{ old('age_range') == '60+' ? 'selected' : '' }}>60+</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Sexo (para estadísticas)</label>
                    <select name="gender"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                        <option value="Prefiere no decir" {{ old('gender') == 'Prefiere no decir' ? 'selected' : '' }}>
                            Prefiere no decir</option>
                        <option value="Femenino" {{ old('gender') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Masculino" {{ old('gender') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Otro" {{ old('gender') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Territorio / sector</label>
                    <input type="text" name="territory" value="{{ old('territory') }}"
                        placeholder="Ej: Río Puelo / Sector ..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                </div>

                <div class="col-span-12 space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Observaciones</label>
                    <textarea name="observations" rows="4"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">{{ old('observations') }}</textarea>
                </div>

                <div class="col-span-12 pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="btn-primary w-full md:w-auto px-8">Guardar ficha</button>
                </div>
            </div>
        </form>
    </div>
@endsection