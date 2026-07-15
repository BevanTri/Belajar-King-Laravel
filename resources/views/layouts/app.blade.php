<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>👤</text></svg>">
    <title>@yield('title', 'Profil App')</title>
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

        #btnToggle { padding: 8px 18px; border: 2px solid white; background: transparent; color: white; border-radius: 20px; cursor: pointer; font-size: 14px; transition: background 0.2s; }
        #btnToggle:hover { background: rgba(255,255,255,0.1); }

        .card { background-color: white; padding: 28px; margin-bottom: 20px; border-radius: 12px; border: 1px solid #e0e0e0; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .card h2 { margin-bottom: 16px; color: #065A82; font-size: 1.4rem; border-bottom: 2px solid #21B0A7; padding-bottom: 10px; }

        #fakta { background: linear-gradient(135deg, #065A82, #1C7293); color: white; text-align: center; }
        #fakta h2 { color: white; border-bottom-color: rgba(255,255,255,0.3); }
        #isi-fakta { font-size: 1.1rem; line-height: 1.7; font-style: italic; margin: 18px 0; min-height: 60px; }
        #btnRefresh { padding: 10px 28px; background: white; color: #065A82; border: none; border-radius: 25px; cursor: pointer; font-weight: 600; transition: opacity 0.2s; }
        #btnRefresh:hover { opacity: 0.85; }

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
        body.dark .card h2 { color: #88c0d0; border-bottom-color: #21B0A7; }
        body.dark .hero-card { background: #0f2844; }
        body.dark .skill-tag { background: #1a4a6e; }
        body.dark a { color: #88c0d0; }
        body.dark #fakta { background: linear-gradient(135deg, #0a1628, #1a2a3e); }
        body.dark #btnRefresh { background: #1a1a2e; color: #88c0d0; border: 1px solid #88c0d0; }

        @media (max-width: 480px) {
            .navbar { flex-direction: column; text-align: center; }
            .nav-links { flex-direction: column; width: 100%; }
            .navbar a, #btnToggle { width: 100%; text-align: center; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <span>Pemrograman Web – UNTIRTA</span>
        <div class="nav-links">
            <a href="{{ route('profil') }}">Profil Saya</a>
            <a href="{{ route('tentang') }}">Tentang</a>
            <button id="btnToggle">🌙 Dark Mode</button>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        &copy; {{ date('Y') }} – Bevan Tri Ramadiyas
    </footer>

    <script>
        const btnToggle = document.querySelector("#btnToggle");
        const body = document.body;

        if (localStorage.getItem("darkMode") === "true") {
            body.classList.add("dark");
            btnToggle.textContent = "☀️ Light Mode";
        }

        btnToggle.addEventListener("click", () => {
            body.classList.toggle("dark");
            const isDark = body.classList.contains("dark");
            localStorage.setItem("darkMode", isDark);
            if (body.classList.contains("dark")) {
                btnToggle.textContent = "☀️ Light Mode";
            } else {
                btnToggle.textContent = "🌙 Dark Mode";
            }
        });
    </script>
</body>
</html>