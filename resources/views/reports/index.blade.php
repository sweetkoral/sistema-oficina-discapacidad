@extends('layouts.institutional')

@section('content')
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-base font-bold">Módulo de Reportes</h2>
                <p class="text-xs text-gray-500">Generación de informes consolidados en PDF y Excel</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Export Form -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold uppercase text-gray-400">Generar Reporte Completo</h3>
                <div class="p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                    <form action="{{ route('reports.generate') }}" method="GET" class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 uppercase">Filtrar por Tipo de Discapacidad
                                (Opcional)</label>
                            <select name="disability_type"
                                class="w-full bg-white border border-gray-200 rounded-xl text-sm focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                                <option value="">Todos los tipos</option>
                                <option value="Física">Física</option>
                                <option value="Sensorial">Sensorial</option>
                                <option value="Intelectual">Intelectual</option>
                                <option value="Psíquica">Psíquica</option>
                                <option value="Múltiple">Múltiple</option>
                                <option value="Otras">Otras</option>
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 uppercase">Formato de Salida</label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="format" value="pdf" checked
                                        class="text-[#0b2e59] focus:ring-[#0b2e59]">
                                    <span class="text-sm">Documento PDF</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="format" value="excel"
                                        class="text-[#0b2e59] focus:ring-[#0b2e59]">
                                    <span class="text-sm">Planilla Excel</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Descargar Reporte
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold uppercase text-gray-400">Información del Sistema</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="p-4 border border-gray-100 rounded-2xl bg-white shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2a4 4 0 00-4-4H5m11 0h.01M16 21h4a2 2 0 012 2v1H2v-1a2 2 0 012-2h4m7-7a4 4 0 11-8 0 4 4 0 018 0zM9 9a1 1 0 000-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400 uppercase font-bold">Privacidad de Datos</div>
                            <p class="text-xs text-gray-600">Todos los reportes cumplen con la normativa de protección de
                                datos sensibles.</p>
                        </div>
                    </div>

                    <div class="p-4 border border-gray-100 rounded-2xl bg-white shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400 uppercase font-bold">Frecuencia de Actualización</div>
                            <p class="text-xs text-gray-600">Los datos se actualizan en tiempo real según los registros
                                ingresados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection