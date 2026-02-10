@extends('layouts.institutional')

@section('content')
    <div class="card p-6">
        <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4">
            <div>
                <h2 class="text-base font-bold">Usuarios registrados</h2>
                <p class="text-xs text-gray-500">Listado con acciones + filtros por perfil y comuna</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <form action="{{ route('beneficiaries.index') }}" method="GET" class="flex flex-wrap gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Buscar por RUT o Nombre..."
                        class="text-xs border border-gray-200 rounded-xl px-4 py-2 focus:ring-[#0b2e59] focus:border-[#0b2e59] min-w-[200px]">

                    <select name="commune"
                        class="text-xs border border-gray-200 rounded-xl px-4 py-2 focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                        <option value="">Todas las Comunas</option>
                        @foreach($communes as $commune)
                            <option value="{{ $commune }}" {{ request('commune') == $commune ? 'selected' : '' }}>{{ $commune }}
                            </option>
                        @endforeach
                    </select>

                    <select name="disability_type"
                        class="text-xs border border-gray-200 rounded-xl px-4 py-2 focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                        <option value="">Todos los Tipos</option>
                        <option value="Física" {{ request('disability_type') == 'Física' ? 'selected' : '' }}>Física</option>
                        <option value="Sensorial" {{ request('disability_type') == 'Sensorial' ? 'selected' : '' }}>Sensorial
                        </option>
                        <option value="Intelectual" {{ request('disability_type') == 'Intelectual' ? 'selected' : '' }}>
                            Intelectual</option>
                        <option value="Psíquica" {{ request('disability_type') == 'Psíquica' ? 'selected' : '' }}>Psíquica
                        </option>
                        <option value="Múltiple" {{ request('disability_type') == 'Múltiple' ? 'selected' : '' }}>Múltiple
                        </option>
                        <option value="Otras" {{ request('disability_type') == 'Otras' ? 'selected' : '' }}>Otras</option>
                    </select>

                    <button type="submit"
                        class="p-2 bg-gray-100 border border-gray-200 rounded-xl hover:bg-gray-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    @if(request()->anyFilled(['search', 'commune', 'disability_type']))
                        <a href="{{ route('beneficiaries.index') }}"
                            class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition-colors" title="Limpiar filtros">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </form>
                <a href="{{ route('beneficiaries.create') }}" class="btn-primary text-sm flex items-center gap-2">
                    <span>+ Agregar</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-gray-400 font-semibold border-b border-gray-100">
                        <th class="pb-3 px-2">Nombre</th>
                        <th class="pb-3 px-2">RUT</th>
                        <th class="pb-3 px-2">Perfil</th>
                        <th class="pb-3 px-2">Comuna</th>
                        <th class="pb-3 px-2">Discapacidad</th>
                        <th class="pb-3 px-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($beneficiaries as $beneficiary)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-2 font-medium">{{ $beneficiary->full_name }}</td>
                            <td class="py-4 px-2">
                                <span
                                    class="text-[11px] text-gray-500 font-mono bg-gray-100 px-2 py-0.5 rounded-full border border-gray-200">
                                    {{ $beneficiary->rut }}
                                </span>
                            </td>
                            <td class="py-4 px-2">
                                <span
                                    class="text-[11px] bg-slate-100 text-slate-600 px-2 py-1 rounded-full border border-slate-200 uppercase font-semibold">
                                    {{ $beneficiary->profile_type }}
                                </span>
                            </td>
                            <td class="py-4 px-2 text-gray-600">{{ $beneficiary->commune }}</td>
                            <td class="py-4 px-2">
                                <span
                                    class="text-[11px] bg-blue-50 text-blue-600 px-2 py-1 rounded-full border border-blue-100 uppercase font-semibold">
                                    {{ $beneficiary->disability_type }}
                                </span>
                            </td>
                            <td class="py-4 px-2 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('beneficiaries.edit', $beneficiary) }}"
                                        class="p-2 text-gray-400 hover:text-[#0b2e59] transition-colors" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('beneficiaries.destroy', $beneficiary) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors"
                                            title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection