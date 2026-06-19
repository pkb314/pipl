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
                    <p class="rule-label text-xs font-black uppercase text-pipl-red">Kontakt</p>
                    <h2 class="mt-4 text-3xl font-black md:text-5xl">Zgłoś zainteresowanie członkostwem.</h2>
                    <p class="mt-5 text-lg leading-8 text-pipl-graphite">
                        Po potwierdzeniu adresu e-mail skontaktujemy się, aby przedstawić zasady członkostwa, zakres współpracy i dalsze kroki.
                    </p>
                    <div class="mt-8 border-l-4 border-pipl-red bg-pipl-paper p-5 text-sm leading-6 text-pipl-graphite">
                        Wysłanie formularza nie oznacza automatycznego przyjęcia do Izby. Członkostwo wymaga akceptacji dokumentów organizacji i decyzji właściwego organu.
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
                                <div class="col-span-2 md:col-span-1">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Imię</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="field w-full rounded border @error('name') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Jan" required>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Nazwisko</label>
                                    <input type="text" name="surname" value="{{ old('surname') }}" class="field w-full rounded border @error('surname') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Kowalski" required>
                                </div>
                                <div class="col-span-2">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Nazwa firmy</label>
                                    <input type="text" name="company" value="{{ old('company') }}" class="field w-full rounded border @error('company') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Nazwa przedsiębiorstwa" required>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Adres</label>
                                    <input type="text" name="adres" value="{{ old('adres') }}" class="field w-full rounded border @error('adres') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Ulica, numer, kod pocztowy, miasto" required>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Gmina</label>
                                    <input type="text" name="gmina" value="{{ old('gmina') }}" class="field w-full rounded border @error('gmina') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Nazwa gminy" required>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">Telefon</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" class="field w-full rounded border @error('phone') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="+48 000 000 000" required>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="mb-2 block text-sm font-bold text-pipl-graphite">E-mail</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="field w-full rounded border @error('email') border-red-500 bg-red-50 @else border-pipl-line bg-pipl-porcelain @enderror p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="adres@firma.pl" required>
                                </div>
                                <div class="col-span-2 border border-pipl-line bg-pipl-paper p-4 text-sm leading-6 text-pipl-graphite">
                                    Dane wykorzystamy wyłącznie do obsługi zgłoszenia i kontaktu w sprawie członkostwa. Szczegóły opisuje <a href="{{ route('legal.privacy') }}" class="font-bold text-pipl-red underline">polityka prywatności</a>, a zasady członkostwa określa <a href="{{ route('legal.terms') }}" class="font-bold text-pipl-red underline">regulamin</a>.
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
    });
</script>
</body>
</html>
