<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('logo.jpeg') }}" type="image/jpeg">
    <title>{{ $title ?? 'PIPL' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pipl: {
                            ink: '#182126',
                            graphite: '#344047',
                            steel: '#65727C',
                            paper: '#F6F4EF',
                            porcelain: '#FAFAF8',
                            line: '#D9DDD9',
                            red: '#A8242D',
                            redDark: '#7D1920',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: Inter, ui-sans-serif, system-ui, sans-serif; }
        .rule-label { letter-spacing: .14em; }
        .legal-copy p { margin-top: .85rem; line-height: 1.78; color: #344047; }
        .legal-copy h2 { margin-top: 2.6rem; border-top: 1px solid #D9DDD9; padding-top: 1.5rem; font-size: 1.45rem; line-height: 1.25; font-weight: 900; color: #182126; }
        .legal-copy h3 { margin-top: 1.5rem; font-size: 1.06rem; line-height: 1.35; font-weight: 900; color: #A8242D; }
        .legal-copy .document-title { margin: 0 0 1.4rem; border: 0; padding: 0; font-size: clamp(1.65rem, 4vw, 2.35rem); line-height: 1.05; text-transform: uppercase; }
        .legal-copy .page-marker { display: none; }
    </style>
</head>
<body class="bg-pipl-porcelain text-pipl-ink antialiased">
<nav class="border-b border-pipl-line bg-pipl-paper">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 md:px-6">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('logo.jpeg') }}" alt="Logo PIPL" class="h-11 w-auto object-contain">
            <span>
                <span class="block text-sm font-black uppercase text-pipl-ink">Polska Izba</span>
                <span class="block text-xs font-semibold uppercase text-pipl-steel">Przedsiębiorców Lokalnych</span>
            </span>
        </a>
        <div class="flex gap-4 text-sm font-bold text-pipl-graphite">
            <a href="{{ route('legal.terms') }}" class="hover:text-pipl-red">Regulamin</a>
            <a href="{{ route('legal.privacy') }}" class="hover:text-pipl-red">Prywatność</a>
            @auth
                <a href="{{ route('admin.leads') }}" class="hover:text-pipl-red">Panel</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-pipl-red">Logowanie</a>
            @endauth
        </div>
    </div>
</nav>

<main class="mx-auto max-w-6xl px-4 py-10 md:px-6 md:py-14">
    @yield('content')
</main>

<footer class="border-t border-pipl-line bg-pipl-paper py-8 text-sm text-pipl-graphite">
    <div class="mx-auto grid max-w-7xl gap-5 px-4 md:grid-cols-[1.2fr_.8fr] md:px-6">
        <div>
            <p><strong class="text-pipl-ink">{{ config('organization.name') }}</strong> &copy; {{ date('Y') }}</p>
            <p class="mt-2 leading-6">
                {{ config('organization.legal_form') }} | KRS: {{ config('organization.krs') }} | NIP: {{ config('organization.nip') }} | REGON: {{ config('organization.regon') }}<br>
                {{ config('organization.address') }}
            </p>
        </div>
        <div class="flex flex-wrap content-start gap-4 font-semibold md:justify-end">
            <a href="{{ url('/') }}" class="hover:text-pipl-red">Strona główna</a>
            <a href="{{ route('legal.terms') }}" class="hover:text-pipl-red">Regulamin</a>
            <a href="{{ route('legal.privacy') }}" class="hover:text-pipl-red">Polityka prywatności</a>
        </div>
    </div>
</footer>
</body>
</html>
