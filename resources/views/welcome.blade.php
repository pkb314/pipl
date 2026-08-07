<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Polska Izba Przedsiębiorców Lokalnych wspiera przedsiębiorców w reprezentacji interesów, współpracy gospodarczej i profesjonalizacji lokalnego biznesu.">
    <link rel="icon" href="{{ asset('logo.jpeg') }}" type="image/jpeg">
    <title>Polska Izba Przedsiębiorców Lokalnych</title>
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
                            green: '#2F5D50',
                            amber: '#B08434',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        quiet: '0 18px 48px rgba(24, 33, 38, 0.08)',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: Inter, ui-sans-serif, system-ui, sans-serif; }
        .text-balance { text-wrap: balance; }
        .nav-backdrop { backdrop-filter: blur(18px); }
        .hero-image::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(24,33,38,.95) 0%, rgba(24,33,38,.84) 43%, rgba(24,33,38,.46) 100%),
                linear-gradient(0deg, rgba(24,33,38,.30), rgba(24,33,38,.08));
        }
        .rule-label {
            letter-spacing: .14em;
        }
        .reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .7s ease, transform .7s ease;
        }
        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        .field {
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }
        .site-nav {
            transition: background-color .25s ease, border-color .25s ease, color .25s ease;
        }
        .site-nav.is-over-hero {
            border-color: rgba(255, 255, 255, .16);
            background: rgba(24, 33, 38, .62);
            color: #fff;
        }
        .site-nav.is-over-hero .brand-main,
        .site-nav.is-over-hero .nav-link {
            color: #fff;
        }
        .site-nav.is-over-hero .brand-sub {
            color: rgba(255, 255, 255, .72);
        }
        .site-nav.is-over-hero .nav-cta {
            background: #fff;
            color: #182126;
        }
        .site-nav.is-over-hero .nav-cta:hover {
            background: #F6F4EF;
        }
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .reveal { opacity: 1; transform: none; transition: none; }
        }
        .ts-wrapper {
            position: relative;
            width: 100%;
            border-radius: 0.25rem;
            border: 1px solid #D9DDD9;
            background: #F6F4EF;
            padding: 0;
        }
        .ts-wrapper:focus-within {
            border-color: #A8242D;
            box-shadow: 0 0 0 4px rgba(168, 36, 45, 0.1);
        }
        .ts-wrapper .ts-control {
            border: none;
            background: transparent;
            box-shadow: none;
            padding: 1rem;
            font-size: 1rem;
            border-radius: 0;
            outline: none;
        }
        .ts-wrapper .ts-control .ts-input {
            color: #182126;
            padding: 0;
        }
        .ts-wrapper .ts-control .ts-input::placeholder {
            color: #65727C;
        }
        .ts-wrapper .ts-dropdown {
            border: 1px solid #D9DDD9;
            border-radius: 0;
            background: #fff;
            box-shadow: 0 18px 48px rgba(24, 33, 38, 0.15);
            max-height: 240px;
            z-index: 50;
        }
        .ts-wrapper .ts-dropdown .ts-dropdown-content {
            max-height: 240px;
        }
        .ts-wrapper .ts-dropdown .option,
        .ts-wrapper .ts-dropdown .option.active {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            line-height: 1.4;
            color: #344047;
        }
        .ts-wrapper .ts-dropdown .option.selected,
        .ts-wrapper .ts-dropdown .option.active.selected {
            background: #A8242D;
            color: #fff;
        }
        .ts-wrapper .ts-dropdown .option:hover {
            background: #F6F4EF;
        }
        .ts-wrapper .ts-dropdown .option.selected:hover,
        .ts-wrapper .ts-dropdown .option.active.selected:hover {
            background: #7D1920;
        }
        .ts-wrapper.has-items .ts-control {
            color: #182126;
        }
        .ts-wrapper .ts-control .item {
            color: #182126;
            font-size: 1rem;
        }
    </style>
</head>
<body class="bg-pipl-porcelain text-pipl-ink antialiased">
<div class="overflow-x-hidden">
    <nav id="siteNav" class="site-nav nav-backdrop fixed inset-x-0 top-0 z-50 border-b border-white/70 bg-pipl-porcelain/92">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 md:px-6">
            <a href="#start" class="flex items-center gap-3" aria-label="Polska Izba Przedsiębiorców Lokalnych">
                <img src="{{ asset('logo.jpeg') }}" alt="Logo PIPL" class="h-11 w-auto object-contain">
                <span class="leading-tight">
                    <span class="brand-main block text-sm font-black uppercase text-pipl-ink">Polska Izba</span>
                    <span class="brand-sub block text-xs font-semibold uppercase text-pipl-steel">Przedsiębiorców Lokalnych</span>
                </span>
            </a>
            <div class="hidden items-center gap-7 text-sm font-semibold text-pipl-graphite lg:flex">
                <a href="#rola" class="nav-link transition hover:text-pipl-red">Rola Izby</a>
                <a href="#zakres" class="nav-link transition hover:text-pipl-red">Zakres wsparcia</a>
                <a href="#czlonkostwo" class="nav-link transition hover:text-pipl-red">Członkostwo</a>
                <a href="{{ route('legal.terms') }}" class="nav-link transition hover:text-pipl-red">Regulamin</a>
                <a href="{{ route('legal.privacy') }}" class="nav-link transition hover:text-pipl-red">Prywatność</a>
            </div>
            <a href="#formularz" class="nav-cta inline-flex h-10 items-center justify-center rounded px-4 text-sm font-bold text-white bg-pipl-red transition hover:bg-pipl-redDark">
                Kontakt
            </a>
        </div>
    </nav>

    <header id="start" class="relative min-h-[88vh] bg-pipl-ink pt-24 text-white">
        <div class="hero-image absolute inset-0">
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2200&q=80"
                 alt="Centrum biznesowe"
                 class="h-full w-full object-cover">
        </div>
        <div class="relative z-10 mx-auto grid max-w-7xl gap-12 px-4 pb-14 pt-20 md:px-6 md:pt-28 lg:grid-cols-[1.05fr_.95fr] lg:pb-20">
            <div class="reveal max-w-4xl">
                <p class="rule-label text-xs font-bold uppercase text-red-200">Samorząd gospodarczy lokalnych przedsiębiorców</p>
                <h1 class="text-balance mt-5 max-w-4xl text-4xl font-black leading-[1.04] md:text-6xl">
                    Instytucjonalne wsparcie dla firm, które chcą działać skuteczniej i mieć silniejszy głos.
                </h1>
                <p class="mt-7 max-w-3xl text-lg leading-8 text-gray-100">
                    {{ config('organization.short_name') }} reprezentuje interesy przedsiębiorców, tworzy warunki do współpracy gospodarczej i wspiera profesjonalizację firm działających w lokalnych społecznościach.
                </p>
                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="#formularz" class="inline-flex justify-center rounded bg-pipl-red px-7 py-4 text-base font-bold text-white transition hover:bg-pipl-redDark">
                        Skontaktuj się z Izbą
                    </a>
                    <a href="{{ route('legal.terms') }}" class="inline-flex justify-center rounded border border-white/35 bg-white/8 px-7 py-4 text-base font-bold text-white transition hover:bg-white/14">
                        Dokumenty organizacji
                    </a>
                </div>
            </div>

            <aside class="reveal self-end border-l border-white/18 pl-6 lg:justify-self-end">
                <p class="rule-label text-xs font-bold uppercase text-red-200">Obszary działania</p>
                <dl class="mt-6 grid gap-6">
                    <div>
                        <dt class="text-2xl font-black">Reprezentacja</dt>
                        <dd class="mt-2 max-w-md text-sm leading-6 text-gray-300">Dialog z administracją i opiniowanie spraw istotnych dla przedsiębiorców.</dd>
                    </div>
                    <div>
                        <dt class="text-2xl font-black">Współpraca</dt>
                        <dd class="mt-2 max-w-md text-sm leading-6 text-gray-300">Budowanie relacji pomiędzy firmami, instytucjami i ekspertami.</dd>
                    </div>
                    <div>
                        <dt class="text-2xl font-black">Rozwój</dt>
                        <dd class="mt-2 max-w-md text-sm leading-6 text-gray-300">Dostęp do wiedzy, praktyki rynkowej i inicjatyw wspierających profesjonalizację biznesu.</dd>
                    </div>
                </dl>
            </aside>
        </div>
    </header>

    <main>
        <section id="rola" class="border-b border-pipl-line bg-pipl-paper py-16 md:py-20">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 md:px-6 lg:grid-cols-[.75fr_1.25fr]">
                <div class="reveal">
                    <p class="rule-label text-xs font-black uppercase text-pipl-red">Rola Izby</p>
                    <h2 class="mt-4 text-3xl font-black leading-tight md:text-5xl">Nie jesteśmy klubem spotkań. Jesteśmy strukturą współpracy gospodarczej.</h2>
                </div>
                <div class="reveal grid gap-6 text-lg leading-8 text-pipl-graphite">
                    <p>
                        Izba działa po to, aby przedsiębiorcy nie musieli rozwiązywać systemowych problemów pojedynczo. Łączymy doświadczenie firm, wiedzę ekspercką i formalną reprezentację w sprawach, które wpływają na warunki prowadzenia działalności.
                    </p>
                    <p>
                        W praktyce oznacza to wsparcie w dostępie do informacji, organizację współpracy, promowanie dobrych praktyk oraz wzmacnianie głosu przedsiębiorców w relacjach z otoczeniem instytucjonalnym.
                    </p>
                </div>
            </div>
        </section>

        <section id="zakres" class="bg-pipl-porcelain py-20 md:py-24">
            <div class="mx-auto max-w-7xl px-4 md:px-6">
                <div class="reveal max-w-3xl">
                    <p class="rule-label text-xs font-black uppercase text-pipl-red">Zakres wsparcia</p>
                    <h2 class="mt-4 text-3xl font-black md:text-5xl">Obszary, w których Izba tworzy realną wartość dla przedsiębiorców.</h2>
                </div>

                <div class="mt-12 divide-y divide-pipl-line border-y border-pipl-line">
                    <article class="reveal grid gap-5 py-8 md:grid-cols-[180px_1fr_.9fr] md:items-start">
                        <p class="text-sm font-black uppercase text-pipl-red">01</p>
                        <h3 class="text-2xl font-black">Reprezentacja interesów</h3>
                        <p class="leading-7 text-pipl-graphite">Wspieramy przedsiębiorców w sprawach dotyczących otoczenia prawnego, praktyk administracyjnych i warunków prowadzenia działalności gospodarczej.</p>
                    </article>
                    <article class="reveal grid gap-5 py-8 md:grid-cols-[180px_1fr_.9fr] md:items-start">
                        <p class="text-sm font-black uppercase text-pipl-red">02</p>
                        <h3 class="text-2xl font-black">Wymiana wiedzy i doświadczeń</h3>
                        <p class="leading-7 text-pipl-graphite">Organizujemy działania edukacyjne, informacyjne i konsultacyjne, które pomagają podejmować decyzje w oparciu o aktualną wiedzę i praktykę rynku.</p>
                    </article>
                    <article class="reveal grid gap-5 py-8 md:grid-cols-[180px_1fr_.9fr] md:items-start">
                        <p class="text-sm font-black uppercase text-pipl-red">03</p>
                        <h3 class="text-2xl font-black">Relacje gospodarcze</h3>
                        <p class="leading-7 text-pipl-graphite">Tworzymy przestrzeń do współpracy pomiędzy przedsiębiorcami, instytucjami, organizacjami i środowiskami wspierającymi rozwój lokalnej gospodarki.</p>
                    </article>
                    <article class="reveal grid gap-5 py-8 md:grid-cols-[180px_1fr_.9fr] md:items-start">
                        <p class="text-sm font-black uppercase text-pipl-red">04</p>
                        <h3 class="text-2xl font-black">Profesjonalizacja firm</h3>
                        <p class="leading-7 text-pipl-graphite">Wspieramy rozwój kompetencji, standardów zarządzania i gotowości firm do działania na szerszych rynkach.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="bg-pipl-ink py-20 text-white md:py-24">
            <div class="mx-auto grid max-w-7xl gap-12 px-4 md:px-6 lg:grid-cols-[.9fr_1.1fr]">
                <div class="reveal">
                    <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                         alt="Nowoczesna przestrzeń biurowa"
                         class="aspect-[4/3] w-full rounded object-cover shadow-quiet">
                </div>
                <div class="reveal self-center">
                    <p class="rule-label text-xs font-black uppercase text-red-200">Dla kogo</p>
                    <h2 class="mt-4 text-3xl font-black md:text-5xl">Dla przedsiębiorców, którzy chcą uczestniczyć w rozwoju otoczenia biznesowego.</h2>
                    <div class="mt-8 grid gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="border-t border-white/18 pt-5">
                            <h3 class="font-black">Mikro, małe i średnie firmy</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-300">Firmy, dla których dostęp do wiedzy, relacji i reprezentacji ma bezpośrednie znaczenie operacyjne.</p>
                        </div>
                        <div class="border-t border-white/18 pt-5">
                            <h3 class="font-black">Firmy rodzinne</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-300">Przedsiębiorstwa budujące trwałość, sukcesję i profesjonalne standardy działania.</p>
                        </div>
                        <div class="border-t border-white/18 pt-5">
                            <h3 class="font-black">Nowe inicjatywy</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-300">Zespoły rozwijające projekty, które potrzebują kontaktu z rynkiem i doświadczonymi przedsiębiorcami.</p>
                        </div>
                        <div class="border-t border-white/18 pt-5">
                            <h3 class="font-black">Partnerzy instytucjonalni</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-300">Podmioty współpracujące na rzecz przedsiębiorczości, edukacji i lokalnego rozwoju gospodarczego.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="czlonkostwo" class="bg-pipl-paper py-20 md:py-24">
            <div class="mx-auto max-w-7xl px-4 md:px-6">
                <div class="reveal grid gap-10 lg:grid-cols-[.75fr_1.25fr]">
                    <div>
                        <p class="rule-label text-xs font-black uppercase text-pipl-red">Członkostwo</p>
                        <h2 class="mt-4 text-3xl font-black md:text-5xl">Członkostwo oparte na deklaracji, zasadach i aktywnym udziale.</h2>
                    </div>
                    <div class="divide-y divide-pipl-line border-y border-pipl-line bg-pipl-porcelain">
                        <div class="grid gap-4 p-6 md:grid-cols-[160px_1fr]">
                            <p class="font-black text-pipl-red">Deklaracja</p>
                            <p class="leading-7 text-pipl-graphite">Przedsiębiorca składa deklarację członkowską i akceptuje statut oraz regulamin członkostwa.</p>
                        </div>
                        <div class="grid gap-4 p-6 md:grid-cols-[160px_1fr]">
                            <p class="font-black text-pipl-red">Decyzja</p>
                            <p class="leading-7 text-pipl-graphite">Status członka przyznawany jest na podstawie decyzji Zarządu, zgodnie z kryteriami określonymi w dokumentach Izby.</p>
                        </div>
                        <div class="grid gap-4 p-6 md:grid-cols-[160px_1fr]">
                            <p class="font-black text-pipl-red">Udział</p>
                            <p class="leading-7 text-pipl-graphite">Członkostwo zakłada aktywność, wymianę doświadczeń i wspieranie inicjatyw służących środowisku przedsiębiorców.</p>
                        </div>
                        <div class="grid gap-4 p-6 md:grid-cols-[160px_1fr]">
                            <p class="font-black text-pipl-red">Dokumenty</p>
                            <p class="leading-7 text-pipl-graphite">Statut, regulamin członkostwa i zasady ochrony danych są dostępne w stopce strony oraz w sekcji dokumentów.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="formularz" class="bg-pipl-porcelain py-20 md:py-24">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 md:px-6 lg:grid-cols-[.8fr_1.2fr]">
                <div class="reveal">
                    <p class="rule-label text-xs font-black uppercase text-pipl-red">Zgłoszenie</p>
                    <h2 class="mt-4 text-3xl font-black md:text-5xl">Zostań Koordynatorem Gminnym PIPL.</h2>
                    <p class="mt-5 text-lg leading-8 text-pipl-graphite">
                        Po potwierdzeniu adresu e-mail skontaktujemy się, aby przedstawić zasady współpracy i dalsze kroki. Wszystkie pola formularza są wymagane.
                    </p>
                    <div class="mt-8 border-l-4 border-pipl-red bg-pipl-paper p-5 text-sm leading-6 text-pipl-graphite">
                        Wysłanie formularza nie oznacza automatycznego przyjęcia do Izby. O wyborze Koordynatora Gminnego decyduje właściwy organ na podstawie przesłanych odpowiedzi.
                    </div>
                </div>

                <div class="reveal border border-pipl-line bg-white shadow-quiet">
                    @if(session('success'))
                        <div class="p-8 md:p-12">
                            <p class="rule-label text-xs font-black uppercase text-pipl-green">Potwierdzenie</p>
                            <h3 class="mt-3 text-3xl font-black">Dziękujemy za potwierdzenie zgłoszenia.</h3>
                            <p class="mt-4 leading-7 text-pipl-graphite">Dane zostały przekazane do obsługi. Przedstawiciel Izby skontaktuje się w sprawie dalszych kroków.</p>
                        </div>
                    @elseif(session('email_sent'))
                        <div class="p-8 md:p-12">
                            <p class="rule-label text-xs font-black uppercase text-pipl-red">Weryfikacja adresu</p>
                            <h3 class="mt-3 text-3xl font-black">Sprawdź skrzynkę odbiorczą.</h3>
                            <p class="mt-4 leading-7 text-pipl-graphite">Wysłaliśmy link potwierdzający na podany adres e-mail. Kliknięcie linku kończy etap weryfikacji zgłoszenia.</p>
                            <p class="mt-4 text-sm text-pipl-steel">Jeżeli wiadomość nie dotarła, sprawdź folder SPAM.</p>
                        </div>
                    @else
                        <div class="p-5 md:p-8">
                            @if ($errors->any() || session('error'))
                                <div class="mb-8 border border-red-200 bg-red-50 p-4">
                                    <h3 class="text-sm font-black text-red-900">Formularz wymaga uzupełnienia</h3>
                                    <div class="mt-2 text-sm leading-6 text-red-800">
                                        @if(session('error'))
                                            <p>{{ session('error') }}</p>
                                        @else
                                            <ul class="list-disc space-y-1 pl-5">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('form.submit') }}" method="POST" class="grid grid-cols-2 gap-4 md:gap-5">
                                @csrf
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Email address *</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="field w-full rounded border @error('email') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="adres@firma.pl" required>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Imię i nazwisko *</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="field w-full rounded border @error('name') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Jan Kowalski" required>
                                    <input type="hidden" name="surname" value="">
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Gmina, którą chcesz reprezentować i dlaczego właśnie ta gmina? *</label>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label class="mb-2 block text-sm font-semibold text-pipl-steel">Gmina</label>
                                            <select id="gmina-select" placeholder="Nazwa gminy" required></select>
                                            <input type="hidden" name="gmina" id="gmina-hidden" value="{{ old('gmina') }}">
                                        </div>
                                        <div>
                                            <label class="mb-2 block text-sm font-semibold text-pipl-steel">Dlaczego właśnie ta gmina?</label>
                                            <textarea name="gmina_reason" rows="3" class="field w-full rounded border @error('gmina_reason') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100 resize-none" placeholder="Napisz kilka zdań..." required>{{ old('gmina_reason') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Telefon *</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" class="field w-full rounded border @error('phone') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="+48 000 000 000" required>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Branża firmy, którą prowadzisz i NIP firmy *</label>
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="text" name="business_sector" value="{{ old('business_sector') }}" class="field w-full rounded border @error('business_sector') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Branża (np. gastronomia, budownictwo)" required>
                                        <input type="text" name="nip" value="{{ old('nip') }}" class="field w-full rounded border @error('nip') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="NIP" required>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Jak dobrze znasz lokalnych przedsiębiorców w swojej gminie? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Znam większość z nich osobiście',
                                            'Znam część z nich',
                                            'Dopiero zaczynam budować sieć kontaktów',
                                            'Nie mam takich kontaktów',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="knows_entrepreneurs" value="{{ $option }}" @checked(old('knows_entrepreneurs') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Czy sam/a prowadzisz lub prowadziłeś/aś działalność gospodarczą? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Tak, aktywnie prowadzę',
                                            'Prowadziłem/am w przeszłości',
                                            'Nie, ale pracuję blisko środowiska biznesowego',
                                            'Nie mam takiego doświadczenia',
                                            'Mam zawieszoną działalność',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="own_business" value="{{ $option }}" @checked(old('own_business') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Gdy spotykasz nową osobę w środowisku biznesowym, jak zwykle postępujesz? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Inicjuję rozmowę i wychodzę z propozycją współpracy',
                                            'Chętnie rozmawiam, gdy ktoś zagadnie',
                                            'Wolę obserwować i stopniowo wchodzić w relacje',
                                            'Networking jest dla mnie trudny',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="meeting_new_people" value="{{ $option }}" @checked(old('meeting_new_people') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Czy organizowałeś/aś kiedyś spotkania, eventy lub zebrania — nawet nieformalne? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Tak, regularnie i na większą skalę',
                                            'Tak, kilka razy',
                                            'Raz lub dwa, przy okazji',
                                            'Nie organizowałem/am',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="organized_events" value="{{ $option }}" @checked(old('organized_events') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Jak reagujesz, gdy ktoś odmawia lub nie jest zainteresowany Twoją propozycją? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Akceptuję spokojnie i wracam po czasie',
                                            'Trochę mnie to frustruje, ale daję radę',
                                            'Trudno mi po odmowie wrócić do tej osoby',
                                            'Odmowa mocno mnie zniechęca',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="handling_refusal" value="{{ $option }}" @checked(old('handling_refusal') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Czy masz kontakty lub relacje z lokalnym samorządem, urzędem gminy? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Tak, aktywnie współpracuję lub współpracowałem/am',
                                            'Znam kilka osób z urzędu',
                                            'Nie mam relacji, ale nie mam też oporów',
                                            'Unikam kontaktów z urzędami',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="local_government_contacts" value="{{ $option }}" @checked(old('local_government_contacts') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Jak opisałbyś/abyś swój styl działania? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Działam z własnej inicjatywy, nie czekam na instrukcje',
                                            'Dobrze mi z ramowym planem i swobodą wykonania',
                                            'Wolę mieć szczegółowe wytyczne co do każdego kroku',
                                            'Dobrze mi w rolach ściśle określonych z zewnątrz',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="working_style" value="{{ $option }}" @checked(old('working_style') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Ile czasu tygodniowo możesz realistycznie poświęcić na tę rolę? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            '3–5 godzin lub więcej',
                                            '1–3 godziny tygodniowo',
                                            'Kilkadziesiąt minut, przy okazji innych aktywności',
                                            'Trudno mi to teraz ocenić',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="weekly_time" value="{{ $option }}" @checked(old('weekly_time') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Co motywuje Cię do objęcia tej roli? (możesz zaznaczyć kilka odpowiedzi) *</label>
                                    @php
                                        $motivationOptions = [
                                            'Chcę budować relacje w lokalnym środowisku przedsiębiorców',
                                            'Chcę mieć realny wpływ na lokalny biznes i samorząd',
                                            'Interesuje mnie możliwość zarobku prowizyjnego',
                                            'Chcę wzmocnić swoją markę osobistą i pozycję w gminie',
                                            'Wierzę w misję PIPL i chcę ją reprezentować',
                                        ];
                                        $oldMotivation = old('motivation', []);
                                    @endphp
                                    <div class="space-y-2">
                                        @foreach ($motivationOptions as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="checkbox" name="motivation[]" value="{{ $option }}" @checked(in_array($option, $oldMotivation)) class="mt-1 rounded border-pipl-line text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                        <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                            <input type="checkbox" name="motivation[]" value="Inne" @checked(in_array('Inne', $oldMotivation)) class="mt-1 rounded border-pipl-line text-pipl-red focus:ring-pipl-red">
                                            Inne
                                        </label>
                                        <div class="pl-8">
                                            <input type="text" name="motivation_other" value="{{ old('motivation_other') }}" class="field w-full rounded border @error('motivation_other') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-3 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Jeśli zaznaczyłeś/aś „Inne", wpisz co..." @required(in_array('Inne', $oldMotivation))>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Czy zdarzało Ci się zachować w tajemnicy informacje powierzone przez kogoś - nawet pod presją? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Tak, dyskrecja to dla mnie podstawa',
                                            'Zazwyczaj tak, choć nie zawsze jest łatwo',
                                            'Nie zawsze - czasem czuję potrzebę podzielenia się',
                                            'Rzadko kiedy udaje mi się utrzymać tajemnicę',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="confidentiality" value="{{ $option }}" @checked(old('confidentiality') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Czy masz aktywne konflikty lub napięcia w lokalnym środowisku biznesowym? *</label>
                                    <div class="space-y-2">
                                        @foreach ([
                                            'Nie, mam dobre relacje ze wszystkimi',
                                            'Są drobne tarcia, ale nic poważnego',
                                            'Jest kilka trudnych relacji, nad którymi pracuję',
                                            'Tak, mam poważny konflikt z kimś w środowisku',
                                        ] as $option)
                                            <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                                                <input type="radio" name="conflicts" value="{{ $option }}" @checked(old('conflicts') === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Dlaczego akurat Ty powinieneś/powinnaś zostać Koordynatorem Gminnym PIPL w swojej gminie? (Napisz 2–5 zdań) *</label>
                                    <textarea name="why_you" rows="4" class="field w-full rounded border @error('why_you') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100 resize-none" placeholder="Twoja odpowiedź..." required>{{ old('why_you') }}</textarea>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Czy jest coś, o czym chciałbyś/chciałabyś nas poinformować przed rozmową? *</label>
                                    <textarea name="additional_info" rows="3" class="field w-full rounded border @error('additional_info') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100 resize-none" placeholder="Twoja odpowiedź (jeśli nie, napisz „nie")..." required>{{ old('additional_info') }}</textarea>
                                </div>
                                <div class="col-span-2 border border-pipl-line bg-pipl-paper p-4 text-sm leading-6 text-pipl-graphite">
                                    Dane wykorzystamy wyłącznie do obsługi zgłoszenia i kontaktu w sprawie współpracy. Szczegóły opisuje <a href="{{ route('legal.privacy') }}" class="font-bold text-pipl-red underline">polityka prywatności</a>, a zasady działania określa <a href="{{ route('legal.terms') }}" class="font-bold text-pipl-red underline">regulamin</a>.
                                </div>
                                <div class="col-span-2">
                                    <button type="submit" class="w-full rounded bg-pipl-red px-6 py-4 text-base font-black text-white transition hover:bg-pipl-redDark">
                                        Wyślij zgłoszenie
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section class="border-y border-pipl-line bg-pipl-paper py-16">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 md:px-6 lg:grid-cols-[.8fr_1.2fr]">
                <div class="reveal">
                    <p class="rule-label text-xs font-black uppercase text-pipl-red">Dokumenty i płatności</p>
                    <h2 class="mt-4 text-3xl font-black">Zasady dostępne przed podjęciem decyzji.</h2>
                    <p class="mt-5 leading-7 text-pipl-graphite">Najważniejsze dokumenty są dostępne niezależnie od formularza. Przed płatnością użytkownik otrzyma informacje o tytule, kwocie i operatorze transakcji.</p>
                </div>
                <div class="reveal grid gap-4 md:grid-cols-3">
                    <a href="{{ route('legal.terms') }}" class="border border-pipl-line bg-white p-5 transition hover:border-pipl-red">
                        <p class="rule-label text-xs font-black uppercase text-pipl-red">Regulamin</p>
                        <h3 class="mt-3 font-black">Statut i członkostwo</h3>
                        <p class="mt-3 text-sm leading-6 text-pipl-graphite">Zasady działania Izby, prawa i obowiązki członków.</p>
                    </a>
                    <a href="{{ route('legal.privacy') }}" class="border border-pipl-line bg-white p-5 transition hover:border-pipl-red">
                        <p class="rule-label text-xs font-black uppercase text-pipl-red">RODO</p>
                        <h3 class="mt-3 font-black">Ochrona danych</h3>
                        <p class="mt-3 text-sm leading-6 text-pipl-graphite">Informacje o przetwarzaniu danych i prawach użytkownika.</p>
                    </a>
                    <div class="border border-pipl-line bg-white p-5">
                        <p class="rule-label text-xs font-black uppercase text-pipl-red">Płatności</p>
                        <h3 class="mt-3 font-black">PayPro S.A. / Przelewy24</h3>
                        <p class="mt-3 text-sm leading-6 text-pipl-graphite">Obsługa transakcji online przez operatora płatności.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-pipl-ink py-10 text-sm text-gray-300">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 md:grid-cols-[1.1fr_.9fr] md:px-6">
            <div>
                <p class="font-black text-white">{{ config('organization.name') }}</p>
                <p class="mt-2 leading-6">
                    &copy; {{ date('Y') }} Wszelkie prawa zastrzeżone.<br>
                    {{ config('organization.legal_form') }} | KRS: {{ config('organization.krs') }} | NIP: {{ config('organization.nip') }} | REGON: {{ config('organization.regon') }}<br>
                    {{ config('organization.address') }}
                </p>
            </div>
            <div class="md:text-right">
                <div class="flex flex-wrap gap-5 font-semibold md:justify-end">
                    <a href="{{ route('legal.terms') }}" class="transition hover:text-white">Regulamin</a>
                    <a href="{{ route('legal.privacy') }}" class="transition hover:text-white">Polityka prywatności</a>
                    <a href="#formularz" class="transition hover:text-white">Kontakt</a>
                </div>
                <p class="mt-4 text-xs uppercase tracking-wide text-gray-500">Płatności online: PayPro S.A. / Przelewy24</p>
            </div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const siteNav = document.getElementById('siteNav');
        const hero = document.getElementById('start');
        const updateNavTheme = () => {
            if (!siteNav || !hero) return;
            const heroBottom = hero.getBoundingClientRect().bottom;
            siteNav.classList.toggle('is-over-hero', heroBottom > siteNav.offsetHeight + 8);
        };

        updateNavTheme();
        window.addEventListener('scroll', updateNavTheme, { passive: true });
        window.addEventListener('resize', updateNavTheme);

        const revealItems = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.14, rootMargin: '0px 0px -36px 0px' });

        revealItems.forEach((item, index) => {
            item.style.transitionDelay = `${Math.min(index % 4, 3) * 70}ms`;
            observer.observe(item);
        });

        @if ($errors->any() || session('error') || session('success') || session('email_sent'))
        const formSection = document.getElementById('formularz');
        if (formSection) {
            formSection.scrollIntoView({ behavior: 'smooth' });
        }
        @endif

        const gminaSelect = new TomSelect('#gmina-select', {
            valueField: 'value',
            labelField: 'label',
            searchField: ['value', 'label'],
            create: false,
            maxOptions: 30,
            placeholder: 'Nazwa gminy',
            preload: false,
            render: {
                option: function(data, escape) {
                    if (data.taken) {
                        return '<div class="py-2 px-3 border-l-4 border-amber-400 bg-amber-50">' +
                            '<span class="font-bold">' + escape(data.value) + '</span>' +
                            ' <span class="text-pipl-steel text-sm">(pow. ' + escape(data.powiat) + ', woj. ' + escape(data.wojewodztwo) + ')</span>' +
                            '<div class="mt-1 text-xs font-bold text-amber-700">Zajęta — możesz zapisać się na listę rezerwową</div>' +
                            '</div>';
                    }
                    return '<div class="py-2 px-3">' +
                        '<span class="font-bold">' + escape(data.value) + '</span>' +
                        ' <span class="text-pipl-steel text-sm">(pow. ' + escape(data.powiat) + ', woj. ' + escape(data.wojewodztwo) + ')</span>' +
                        '<div class="mt-1 text-xs font-bold text-green-700">Wolna</div>' +
                        '</div>';
                },
                item: function(data, escape) {
                    if (data.taken) {
                        return '<div>' + escape(data.value) + ' <span class="text-xs text-amber-600 font-bold">(lista rezerwowa)</span></div>';
                    }
                    return '<div>' + escape(data.value) + '</div>';
                }
            },
            load: function(query, callback) {
                if (!query.length || query.length < 1) return callback();
                fetch('/api/gminy?q=' + encodeURIComponent(query))
                    .then(r => r.json())
                    .then(callback)
                    .catch(() => callback());
            },
            onChange: function(value) {
                document.getElementById('gmina-hidden').value = value;
            }
        });

        @if (old('gmina'))
        gminaSelect.addOption({ value: '{{ old('gmina') }}', label: '{{ old('gmina') }}' });
        gminaSelect.setValue('{{ old('gmina') }}');
        @endif
    });
</script>
</body>
</html>
