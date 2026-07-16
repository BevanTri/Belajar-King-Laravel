<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>👤</text></svg>">
    <title>@yield('title', 'Profil App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f8fa; color: #262626; line-height: 1.7; transition: background 0.3s, color 0.3s; }
        .navbar { background: #0B1F3A; color: white; padding: 16px 28px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .nav-links { display: flex; align-items: center; gap: 18px; }
        .navbar a { color: #21B0A7; text-decoration: none; font-weight: 600; font-size: 0.95rem; }
        .container { max-width: 900px; margin: 32px auto; padding: 0 20px; }
        footer { text-align: center; padding: 24px; color: #888; font-size: 13px; }

        p { margin-bottom: 8px; }
        a { color: #065A82; }
        a:hover { text-decoration: none; }

        .switch-wrap { display:flex; align-items:center; gap:8px; cursor:pointer; user-select:none; }
        .switch-track { width:42px; height:22px; background:#555; border-radius:11px; position:relative; transition:0.2s; flex-shrink:0; }
        .switch-track::after { content:''; width:18px; height:18px; background:white; border-radius:50%; position:absolute; top:2px; left:2px; transition:0.2s; }
        .switch-input { display:none; }
        .switch-input:checked + .switch-track { background:#21B0A7; }
        .switch-input:checked + .switch-track::after { left:22px; }
        .switch-label { font-size:0.85rem; color:white; font-weight:600; }

        .card { background-color: white; padding: 28px; margin-bottom: 20px; border-radius: 12px; border: 1px solid #e0e0e0; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .card h2 { margin-bottom: 16px; color: #065A82; font-size: 1.4rem; border-bottom: 2px solid #21B0A7; padding-bottom: 10px; }

        .hero-card { background: #065A82; color: white; padding: 32px; border-radius: 12px; text-align: center; margin-bottom: 20px; }
        .hero-card h1 { font-size: 1.8rem; margin-bottom: 6px; }
        .hero-card p { margin-bottom: 10px; font-size: 1rem; opacity: 0.9; }
        .badge { display: inline-block; padding: 5px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        .badge-cumlaude { background: #21B0A7; }
        .badge-memuaskan { background: #1C7293; }

        .skill-tag { background: #065A82; color: white; padding: 6px 16px; border-radius: 20px; margin: 4px 6px 4px 0; display: inline-block; font-size: 0.85rem; }
        .info-label { font-weight: 600; }

        body.dark { background-color: #12121e; color: #e0e0e0; }
        body.dark .navbar { background-color: #0a1628; }
        body.dark .card { background-color: #1a1a2e; border-color: #2a2a4a; }
        body.dark input:read-only { background-color: #0d0d1a !important; color: #888; border-color: #2a2a4a; }
        body.dark div[style*="background:#fff3cd"] { background-color: #2a2000 !important; border-color: #665500 !important; color: #ffd700 !important; }
        body.dark .card h2 { color: #88c0d0; border-bottom-color: #21B0A7; }
        body.dark .hero-card { background: #0f2844; }
        body.dark .skill-tag { background: #1a4a6e; }
        body.dark a { color: #88c0d0; }

        body.dark input, body.dark textarea { background: #1a1a2e; color: #e0e0e0; border-color: #2a2a4a; }
        body.dark input:focus, body.dark textarea:focus { outline-color: #88c0d0; }
        body.dark .switch-track { background: #0a1628; }
        body.dark .switch-input:checked + .switch-track { background: #21B0A7; }

        @media (max-width: 480px) {
            .navbar { flex-direction: column; text-align: center; }
            .nav-links { flex-direction: column; width: 100%; }
            .navbar a, .switch-wrap, form { width: 100%; text-align: center; justify-content: center; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <span>Pemrograman Web – UNTIRTA</span>
        <div class="nav-links">
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('mahasiswa.index') }}">Daftar Mahasiswa</a>
                @else
                    @php $myMhs = Auth::user()->mahasiswa; @endphp
                    @if($myMhs)
                        <a href="{{ route('mahasiswa.show', $myMhs->id) }}">Profil Saya</a>
                    @endif
                @endif
                <a href="{{ route('tentang') }}">Tentang</a>
                <span style="color:white;font-size:0.9rem;">Halo, {{ Auth::user()->name }}!</span>
                <label class="switch-wrap">
                    <input type="checkbox" class="switch-input" id="darkSwitch">
                    <span class="switch-track"></span>
                    <span class="switch-label">Dark</span>
                </label>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:transparent;color:#21B0A7;border:2px solid #21B0A7;padding:6px 16px;border-radius:20px;cursor:pointer;font-weight:600;font-size:0.85rem;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="background:#21B0A7;color:white;padding:6px 18px;border-radius:20px;text-decoration:none;font-weight:600;font-size:0.85rem;">Login</a>
                <a href="{{ route('register') }}" style="background:transparent;color:white;border:2px solid white;padding:6px 18px;border-radius:20px;text-decoration:none;font-weight:600;font-size:0.85rem;">Register</a>
                <label class="switch-wrap">
                    <input type="checkbox" class="switch-input" id="darkSwitch">
                    <span class="switch-track"></span>
                    <span class="switch-label">Dark</span>
                </label>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div style="background:#27ae60;color:white;padding:14px 20px;border-radius:8px;margin-bottom:16px;font-weight:600;">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
        {{ $slot ?? '' }}
    </div>

    <footer>
        &copy; {{ date('Y') }} – Bevan Tri Ramadiyas
    </footer>

    <script>
        const darkSwitch = document.querySelector("#darkSwitch");
        const body = document.body;

        if (localStorage.getItem("darkMode") === "true") {
            body.classList.add("dark");
            darkSwitch.checked = true;
        }

        function updateLabel() {
            document.querySelectorAll(".switch-label").forEach(el => el.textContent = darkSwitch.checked ? "Dark" : "Light");
        }

        darkSwitch.addEventListener("change", () => {
            const isDark = darkSwitch.checked;
            body.classList.toggle("dark", isDark);
            localStorage.setItem("darkMode", isDark);
            updateLabel();
        });

        updateLabel();
    </script>
</body>
</html>
