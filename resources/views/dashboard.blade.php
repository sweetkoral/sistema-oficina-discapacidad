@extends('layouts.institutional')

@section('content')
    <div class="grid grid-cols-12 gap-5">
        <!-- Stats -->
        <div class="col-span-12 md:col-span-6 card p-6 flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="text-3xl font-extrabold tracking-tight">{{ $totalBeneficiaries }}</div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Personas registradas</div>
                </div>
                <span
                    class="text-[10px] bg-emerald-50 text-emerald-600 px-2 py-1 rounded-full border border-emerald-100 flex items-center gap-1 font-bold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> SISTEMA ACTIVO
                </span>
            </div>
            <p class="text-xs text-gray-500 leading-relaxed">Registro, administración y seguimiento de personas usuarias con
                resguardo de confidencialidad.</p>
        </div>

        <div class="col-span-12 md:col-span-6 card p-6 flex flex-col justify-between">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="text-3xl font-extrabold tracking-tight">{{ $disabilityTypesCount }}</div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Tipos de discapacidad</div>
                </div>
                <span
                    class="text-[10px] bg-amber-50 text-amber-600 px-2 py-1 rounded-full border border-amber-100 flex items-center gap-1 font-bold">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> CLASIFICADOS
                </span>
            </div>
            <p class="text-xs text-gray-500 leading-relaxed">Tipos de discapacidad identificados en la currícula de
                beneficiarios registrados hoy.</p>
        </div>

        <div class="col-span-12 md:col-span-12 card p-6">
            <h2 class="text-sm font-bold mb-4">Distribución por Tipo de Discapacidad</h2>
            <div class="h-64">
                <canvas id="disabilityChart"></canvas>
            </div>
        </div>

        <div class="col-span-12 md:col-span-7 card p-6">
            <h2 class="text-sm font-bold mb-4">Últimos Registros</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-50">
                            <th class="pb-2">Nombre</th>
                            <th class="pb-2 text-right">RUT</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentBeneficiaries as $ben)
                            <tr>
                                <td class="py-2">{{ $ben->full_name }}</td>
                                <td class="py-2 text-right text-gray-500 font-mono text-[10px]">{{ $ben->rut }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-4 text-center text-gray-400">No hay registros recientes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('beneficiaries.index') }}"
                    class="text-[10px] text-[#0b2e59] font-bold uppercase hover:underline">Ver todos los usuarios →</a>
            </div>
        </div>

        <div class="col-span-12 md:col-span-5 card p-6">
            <h2 class="text-sm font-bold mb-4">Acciones rápidas</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('beneficiaries.create') }}"
                    class="btn-primary text-xs text-center flex items-center justify-center">NUEVO REGISTRO</a>
                <a href="{{ route('export.excel') }}"
                    class="px-3 py-2 border border-gray-200 rounded-xl text-xs hover:bg-gray-50 uppercase font-semibold text-center flex items-center justify-center">EXCEL</a>
                <a href="{{ route('export.pdf') }}"
                    class="px-3 py-2 border border-gray-200 rounded-xl text-xs hover:bg-gray-50 uppercase font-semibold col-span-2 text-center flex items-center justify-center">PDF
                    COMPLETO</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('disabilityChart').getContext('2d');
            const data = @json($statsByType);

            const labels = data.map(item => item.disability_type);
            const values = data.map(item => item.total);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad de Personas',
                        data: values,
                        backgroundColor: 'rgba(11, 46, 89, 0.7)',
                        borderColor: 'rgba(11, 46, 89, 1)',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { display: false }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
@endsection