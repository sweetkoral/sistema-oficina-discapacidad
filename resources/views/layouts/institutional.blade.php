<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Oficina de la Discapacidad') }}</title>

    <!-- Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg: #f3f6fb;
            --surface: #ffffff;
            --surface2: #f8fafc;
            --text: #0f172a;
            --muted: #475569;
            --line: rgba(15, 23, 42, .12);
            --line2: rgba(15, 23, 42, .18);
            --primary: #0b2e59;
            --primary2: #0a264a;
            --accent: #b91c1c;
            --ok: #0f766e;
            --warn: #b45309;
            --danger: #b91c1c;
            --shadow: 0 10px 22px rgba(15, 23, 42, .10);
            --radius: 14px;
            --radius2: 18px;
        }

        body {
            background:
                radial-gradient(900px 600px at 15% 0%, rgba(11, 46, 89, .08) 0%, rgba(243, 246, 251, 0) 60%),
                radial-gradient(700px 500px at 85% 10%, rgba(185, 28, 28, .06) 0%, rgba(243, 246, 251, 0) 55%),
                var(--bg);
            color: var(--text);
        }

        .sidebar {
            background: linear-gradient(180deg, rgba(11, 46, 89, .10), rgba(248, 250, 252, 1));
            border-right: 1px solid var(--line);
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius2);
            box-shadow: var(--shadow);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: var(--primary2);
        }
    </style>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-72 flex-shrink-0 sticky top-0 h-screen p-6">
            <div class="flex flex-col items-center gap-3 pb-6 mb-6 border-b border-gray-200 text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Cochamó" class="w-32 h-32 object-contain">
                <div>
                    <h1 class="text-xs font-bold tracking-[0.2em] uppercase text-[#0b2e59] leading-tight">Oficina de
                        la<br>Discapacidad</h1>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center justify-between p-3 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#0b2e591a] border border-[#0b2e5933]' : 'hover:bg-[#0b2e590f]' }}">
                    <span class="text-sm">Dashboard</span>
                    <span
                        class="text-[10px] text-gray-400 border border-gray-200 px-2 py-0.5 rounded-full bg-slate-50">Inicio</span>
                </a>
                <a href="{{ route('beneficiaries.index') }}"
                    class="flex items-center justify-between p-3 rounded-xl transition-colors {{ request()->routeIs('beneficiaries.*') ? 'bg-[#0b2e591a] border border-[#0b2e5933]' : 'hover:bg-[#0b2e590f]' }}">
                    <span class="text-sm">Usuarios</span>
                    <span
                        class="text-[10px] text-gray-400 border border-gray-200 px-2 py-0.5 rounded-full bg-slate-50">Registro</span>
                </a>
                <a href="{{ route('reports.index') }}"
                    class="flex items-center justify-between p-3 rounded-xl transition-colors {{ request()->routeIs('reports.*') ? 'bg-[#0b2e591a] border border-[#0b2e5933]' : 'hover:bg-[#0b2e590f]' }}">
                    <span class="text-sm">Reportes</span>
                    <span
                        class="text-[10px] text-gray-400 border border-gray-200 px-2 py-0.5 rounded-full bg-slate-50">PDF/XLS</span>
                </a>

                <div class="pt-4 mt-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-red-50 text-red-600 transition-colors">
                            <span class="text-sm">Salir</span>
                            <span
                                class="text-[10px] border border-red-200 px-2 py-0.5 rounded-full bg-red-50">Cerrar</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 space-y-4">
            <!-- Topbar -->
            <header
                class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 flex items-center justify-between gap-4">
                <form action="{{ route('beneficiaries.index') }}" method="GET"
                    class="flex-1 max-w-xl flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-full px-4 py-2">
                    <span class="text-[10px] text-gray-400 font-mono tracking-tighter">BUSCAR</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Buscar por nombre, RUT, email..."
                        class="bg-transparent border-none focus:ring-0 text-sm w-full h-auto p-0">
                    <button type="submit" class="hidden"></button>
                </form>

                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <div class="text-xs font-bold">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-gray-500">Perfil: Admin</div>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-gray-100 border border-gray-200"></div>
                </div>
            </header>

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>
</body>

</html>