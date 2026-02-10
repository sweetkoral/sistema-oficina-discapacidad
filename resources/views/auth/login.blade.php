<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingreso — Plataforma Oficina de la Discapacidad</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #f3f6fb;
            --surface: #ffffff;
            --text: #0f172a;
            --muted: #475569;
            --line: rgba(15, 23, 42, .12);
            --primary: #0b2e59;
            --accent: #b91c1c;
            --shadow: 0 10px 22px rgba(15, 23, 42, .10);
            --radius2: 18px;
        }

        body {
            margin: 0;
            background:
                radial-gradient(900px 600px at 15% 0%, rgba(11, 46, 89, .08) 0%, rgba(243, 246, 251, 0) 60%),
                radial-gradient(700px 500px at 85% 10%, rgba(185, 28, 28, .06) 0%, rgba(243, 246, 251, 0) 55%),
                var(--bg);
        }

        .loginWrap {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 22px;
        }

        .loginCard {
            max-width: 980px;
            width: 100%;
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 14px;
        }

        .hero {
            padding: 24px;
            border-radius: var(--radius2);
            background: linear-gradient(135deg, rgba(11, 46, 89, .10), rgba(185, 28, 28, .06));
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius2);
            box-shadow: var(--shadow);
            padding: 24px;
        }

        .logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
        }

        @media (max-width: 768px) {
            .loginCard {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="font-sans antialiased text-[#0f172a]">
    <div class="loginWrap">
        <div class="loginCard">
            <div class="hero flex flex-col justify-center">
                <div class="flex items-center gap-6 mb-8">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Cochamó"
                        class="w-24 h-24 object-contain border-r-2 border-gray-100 pr-6">
                    <div>
                        <h2 class="text-2xl font-black tracking-tighter uppercase text-[#0b2e59] leading-none">Oficina
                            de la<br>Discapacidad</h2>
                        <div class="mt-2 text-[11px] text-gray-400 font-bold uppercase tracking-[0.2em]">Cochamó —
                            Gestión Pública</div>
                    </div>
                </div>

                <ul class="space-y-3 text-sm text-gray-600 mb-6">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0b2e59]"></span>
                        Registro y administración de personas usuarias
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0b2e59]"></span>
                        Clasificación por tipo de discapacidad + observaciones
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0b2e59]"></span>
                        Estadísticas y reportes exportables (PDF/Excel)
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0b2e59]"></span>
                        Perfiles de acceso y confidencialidad
                    </li>
                </ul>

                <p class="text-[10px] text-gray-400 italic">
                    *Esta plataforma implementa control de acceso y resguardo de datos personales según normativa
                    vigente.
                </p>
            </div>

            <div class="card flex flex-col justify-center">
                <h2 class="text-lg font-bold mb-1">Ingreso</h2>
                <p class="text-xs text-gray-500 mb-6 font-medium uppercase tracking-wider">Acceso con credenciales</p>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 text-xs text-red-600 bg-red-50 p-3 rounded-xl border border-red-100">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="ej: admin@oficina.cl"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm p-3 focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Contraseña</label>
                        <input type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm p-3 focus:ring-[#0b2e59] focus:border-[#0b2e59]">
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <label class="flex items-center text-xs text-gray-500 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-[#0b2e59] focus:ring-[#0b2e59] mr-2">
                            Recordarme
                        </label>
                        <button type="submit"
                            class="bg-[#0b2e59] text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg shadow-[#0b2e5926] hover:bg-[#0a264a] transition-all">
                            ENTRAR
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-[10px] text-gray-400 font-mono">DEMO v1.0</span>
                    <span
                        class="text-[10px] font-bold text-gray-400 uppercase bg-gray-100 px-2 py-0.5 rounded-full border border-gray-200">ADMIN
                        ROLE</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>