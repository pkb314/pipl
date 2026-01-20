<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Polska Izba Przedsiębiorców Lokalnych - Dołącz do nas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pipl: {
                            graphite: '#3F474F', // Primary branding
                            red: '#D71920',      // Accent
                            gray: '#F3F4F6',     // Light BG
                            dark: '#1F2937',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        html { scroll-behavior: smooth; }
        .clip-path-slant { clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%); }
    </style>
</head>
<body class="text-pipl-graphite antialiased bg-white">

<nav class="bg-white border-b border-gray-100 py-4 fixed w-full z-50 top-0 shadow-sm">
    <div class="container mx-auto px-4 md:px-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-pipl-red rounded flex items-center justify-center text-white font-bold text-xl">P</div>
            <div>
                <span class="block text-sm font-bold leading-tight text-pipl-graphite">POLSKA IZBA</span>
                <span class="block text-xs uppercase tracking-wider text-gray-500">Przedsiębiorców Lokalnych</span>
            </div>
        </div>
        <a href="#formularz" class="hidden md:inline-block bg-pipl-graphite text-white text-sm font-semibold px-5 py-2 rounded hover:bg-gray-800 transition">
            Dowiedz się więcej
        </a>
    </div>
</nav>

<header class="relative pt-32 pb-20 md:pt-48 md:pb-32 bg-pipl-graphite text-white overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80"
             alt="Siedziba Izby Gospodarczej"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-pipl-graphite/95 via-pipl-graphite/80 to-pipl-graphite/90"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 md:px-6 text-center max-w-5xl">
        <div class="inline-flex items-center gap-2 py-2 px-4 border border-gray-600 bg-white/5 rounded-full text-xs md:text-sm font-medium tracking-wide uppercase mb-8 backdrop-blur-sm shadow-lg">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
            Oficjalna Organizacja Samorządu Gospodarczego
        </div>

        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight drop-shadow-lg">
            Skuteczna reprezentacja <br class="hidden md:block">
            Twoich interesów.
        </h1>

        <h2 class="text-xl md:text-3xl text-gray-100 font-light mb-8 drop-shadow-md">
            Jesteśmy <span class="text-pipl-red font-bold">IZBĄ GOSPODARCZĄ</span> – Twoim partnerem w rozmowach z urzędami i gwarantem bezpieczeństwa prawnego.
        </h2>

        <p class="text-lg text-gray-300 font-light max-w-3xl mx-auto mb-10 leading-relaxed">
            Zapewniamy realne wsparcie dla mikro i małych przedsiębiorstw. <br class="hidden md:block"> Nie walcz z biurokracją w pojedynkę.
        </p>

        <div class="flex flex-col md:flex-row justify-center gap-4">
            <a href="#formularz" class="bg-pipl-red hover:bg-red-700 text-white font-bold py-4 px-10 rounded-lg text-lg transition duration-300 shadow-xl shadow-red-900/30 transform hover:-translate-y-1 ring-1 ring-white/20">
                Dowiedz się więcej
            </a>

        </div>
    </div>
</header>

<section id="dlaczego" class="py-20 bg-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <h3 class="text-pipl-red font-bold uppercase tracking-widest text-sm mb-2">Filozofia Izby</h3>
                <h2 class="text-3xl md:text-4xl font-bold text-pipl-graphite mb-6 leading-tight">W biznesie samemu jest najdrożej.</h2>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                    Podejmowanie decyzji w odosobnieniu kosztuje czas, pieniądze i niejednokrotnie prowadzi do błędów, których można było uniknąć.
                </p>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    <strong>Polska Izba Przedsiębiorców Lokalnych</strong> to ekosystem wsparcia. Ogólnopolska organizacja, która realnie wspiera lokalnych przedsiębiorców – od codziennych wyzwań po ekspansję. Nie jesteśmy klubem towarzyskim. Jesteśmy narzędziem rozwoju i bezpieczeństwa biznesu.
                </p>

                <div class="flex gap-8 md:gap-12 border-t border-gray-100 pt-8">
                    <div>
                        <span class="block text-4xl font-bold text-pipl-graphite">1000+</span>
                        <span class="text-sm text-gray-500 uppercase tracking-wide">Członków</span>
                    </div>
                    <div>
                        <span class="block text-4xl font-bold text-pipl-red">500+</span>
                        <span class="text-sm text-gray-500 uppercase tracking-wide">Spotkań rocznie</span>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 relative">
                <div class="absolute -top-4 -left-4 w-24 h-24 bg-gray-100 rounded-full z-0"></div>
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Spotkanie przedsiębiorców" class="relative z-10 rounded-lg shadow-2xl w-full object-cover h-[400px]">
                <div class="absolute -bottom-6 -right-6 bg-pipl-graphite text-white p-6 rounded-lg shadow-lg z-20 max-w-xs hidden md:block">
                    <p class="font-medium italic">"Budujemy trwałą przewagę konkurencyjną polskich firm."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-pipl-graphite">Co zyskujesz jako członek Izby?</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Zapewniamy dostęp do wiedzy, kontaktów i narzędzi, które realnie wpływają na rozwój Twojej firmy.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-t-4 border-pipl-red">
                <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center mb-6 text-pipl-red">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Relacje i networking</h3>
                <ul class="space-y-3 text-gray-600 text-sm">
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Comiesięczne spotkania w Twojej gminie</li>
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Dostęp do ogólnopolskich kontaktów</li>
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Wzajemne rekomendacje biznesowe</li>
                </ul>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-t-4 border-pipl-graphite">
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-6 text-pipl-graphite">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Wiedza, która ma sens</h3>
                <ul class="space-y-3 text-gray-600 text-sm">
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Praktyczne szkolenia rynkowe</li>
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Aktualna wiedza prawna i podatkowa</li>
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Bezpośredni dostęp do ekspertów</li>
                </ul>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-t-4 border-pipl-red">
                <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center mb-6 text-pipl-red">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Wsparcie w eksporcie</h3>
                <ul class="space-y-3 text-gray-600 text-sm">
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Pomoc w wejściu na rynki zagraniczne</li>
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Baza partnerów międzynarodowych</li>
                    <li class="flex items-start"><span class="text-pipl-red mr-2">•</span> Wsparcie przy misjach gospodarczych</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-pipl-graphite text-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="grid md:grid-cols-3 gap-12 divide-y md:divide-y-0 md:divide-x divide-gray-600">

            <div class="px-4 md:px-8 pt-8 md:pt-0">
                <span class="text-5xl font-bold text-gray-600 mb-4 block">01</span>
                <h3 class="text-xl font-bold mb-3 text-white">Certyfikacja i formalności</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Informacje o wymaganych certyfikatach krajowych i międzynarodowych. Wsparcie w procesie certyfikacji oraz kontakt z jednostkami certyfikującymi.</p>
            </div>

            <div class="px-4 md:px-8 pt-8 md:pt-0">
                <span class="text-5xl font-bold text-gray-600 mb-4 block">02</span>
                <h3 class="text-xl font-bold mb-3 text-white">Spory bez sądu</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Mediacje gospodarcze, postępowania polubowne. Szybkie i tańsze rozwiązywanie konfliktów biznesowych bez angażowania systemu sądowego.</p>
            </div>

            <div class="px-4 md:px-8 pt-8 md:pt-0">
                <span class="text-5xl font-bold text-gray-600 mb-4 block">03</span>
                <h3 class="text-xl font-bold mb-3 text-white">Dostęp do pieniędzy</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Informacje o dotacjach i funduszach, udział w projektach finansowanych oraz współpraca z instytucjami wspierającymi rozwój.</p>
            </div>

        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-pipl-graphite">Dla kogo jest Izba?</h2>
            <p class="text-gray-600 mt-4">Wspieramy przedsiębiorców na każdym etapie rozwoju.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">

            <div class="p-6 border border-gray-100 rounded-xl hover:border-pipl-red hover:shadow-lg transition group">
                <h3 class="text-xl font-bold mb-2 group-hover:text-pipl-red transition">Mikro, mali i średni</h3>
                <p class="text-gray-600 text-sm">Firmy zatrudniające od kilku do kilkuset pracowników. Trzon polskiej gospodarki potrzebujący wsparcia w codziennych wyzwaniach.</p>
            </div>

            <div class="p-6 border border-gray-100 rounded-xl hover:border-pipl-red hover:shadow-lg transition group">
                <h3 class="text-xl font-bold mb-2 group-hover:text-pipl-red transition">Firmy rodzinne</h3>
                <p class="text-gray-600 text-sm">Przedsiębiorstwa wielopokoleniowe, które cenią tradycję, ale patrzą w przyszłość i szukają nowoczesnych rozwiązań.</p>
            </div>

            <div class="p-6 border border-gray-100 rounded-xl hover:border-pipl-red hover:shadow-lg transition group">
                <h3 class="text-xl font-bold mb-2 group-hover:text-pipl-red transition">Startupy</h3>
                <p class="text-gray-600 text-sm">Innowacyjne młode firmy, które potrzebują mentoringu, kontaktów i wiedzy, aby szybko rozwijać się na rynku.</p>
            </div>

            <div class="p-6 border border-gray-100 rounded-xl hover:border-pipl-red hover:shadow-lg transition group">
                <h3 class="text-xl font-bold mb-2 group-hover:text-pipl-red transition">Korporacje</h3>
                <p class="text-gray-600 text-sm">Duże przedsiębiorstwa szukające możliwości współpracy z lokalnym biznesem i chcące uczestniczyć w rozwoju regionu.</p>
            </div>
        </div>

        <div class="mt-12 text-center max-w-3xl mx-auto bg-red-50 p-6 rounded-lg border border-red-100">
            <p class="text-pipl-graphite font-medium">
                <span class="text-pipl-red font-bold">Osoby planujące rozwój, a nie tylko „przetrwanie”</span> – jeśli myślisz strategicznie o przyszłości swojej firmy i chcesz budować jej wartość, Izba jest dla Ciebie.
            </p>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto px-4 md:px-6">
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div>
                <h3 class="text-xl font-bold text-pipl-graphite mb-2">Wiedza wcześniej</h3>
                <p class="text-gray-600 text-sm">Dowiaduj się o zmianach i trendach przed konkurencją. Bądź o krok do przodu.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-pipl-graphite mb-2">Kontakty szybciej</h3>
                <p class="text-gray-600 text-sm">Buduj wartościowe relacje bez długich poszukiwań. Dostęp do sprawdzonej sieci.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-pipl-graphite mb-2">Decyzje pewniej</h3>
                <p class="text-gray-600 text-sm">Podejmuj decyzje oparte na wsparciu społeczności, która przeszła podobną drogę.</p>
            </div>
        </div>
    </div>
</section>

<section id="formularz" class="py-16 md:py-24 bg-pipl-graphite text-white relative">
    <div class="container mx-auto px-4 md:px-6 max-w-4xl relative z-10">

        <div class="text-center mb-10 md:mb-14">
            <h2 class="text-2xl md:text-4xl font-bold mb-4">Zadbaj o przyszłość swojej firmy.</h2>
            <p class="text-lg text-gray-300">Wypełnij formularz. Skontaktujemy się i przedstawimy korzyści członkostwa.</p>
        </div>

        <div class="bg-white text-gray-800 rounded-2xl shadow-2xl overflow-hidden">

            @if(session('success'))
                <div class="p-12 md:p-20 text-center">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-pipl-graphite mb-4">Dziękujemy za potwierdzenie!</h3>
                    <p class="text-gray-600 text-lg">Twoje zgłoszenie trafiło do systemu. Skontaktujemy się wkrótce.</p>
                </div>

            @elseif(session('email_sent'))
                <div class="p-12 md:p-20 text-center">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-pipl-graphite mb-4">Sprawdź swoją skrzynkę!</h3>
                    <p class="text-gray-600 text-lg mb-6">
                        Wysłaliśmy link potwierdzający na podany adres email.<br>
                        <strong>Kliknij go, aby dokończyć zgłoszenie.</strong>
                    </p>
                    <p class="text-sm text-gray-400">Nie widzisz maila? Sprawdź folder SPAM.</p>
                </div>

            @else
                <div class="p-5 md:p-12">

                    @if ($errors->any() || session('error'))
                        <div class="bg-red-50 border-l-4 border-pipl-red p-4 mb-8 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-bold text-red-800">
                                        Formularz wymaga poprawy
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        @if(session('error'))
                                            <p>{{ session('error') }}</p>
                                        @else
                                            <ul class="list-disc list-inside space-y-1">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('form.submit') }}" method="POST" class="grid grid-cols-2 gap-4 md:gap-6">
                        @csrf

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Imię</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full p-4 text-base bg-gray-50 border @error('name') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red focus:ring-1 focus:ring-pipl-red transition" placeholder="Jan" required>
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Nazwisko</label>
                            <input type="text" name="surname" value="{{ old('surname') }}" class="w-full p-4 text-base bg-gray-50 border @error('surname') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red focus:ring-1 focus:ring-pipl-red transition" placeholder="Kowalski" required>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Nazwa Firmy</label>
                            <input type="text" name="company" value="{{ old('company') }}" class="w-full p-4 text-base bg-gray-50 border @error('company') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red focus:ring-1 focus:ring-pipl-red transition" placeholder="Twoja Firma Sp. z o.o." required>
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Telefon</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full p-4 text-base bg-gray-50 border @error('phone') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red focus:ring-1 focus:ring-pipl-red transition" placeholder="+48 000 000 000" required>
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full p-4 text-base bg-gray-50 border @error('email') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red focus:ring-1 focus:ring-pipl-red transition" placeholder="jan@firma.pl" required>
                        </div>

                        <div class="col-span-2 mt-4">
                            <button type="submit" class="w-full bg-pipl-red hover:bg-red-700 text-white font-bold py-5 rounded-lg text-xl shadow-lg transition duration-300 transform hover:-translate-y-0.5">
                                Wyślij zgłoszenie
                            </button>
                            <p class="text-xs text-gray-400 text-center mt-4 leading-relaxed">
                                Klikając przycisk, wyrażasz zgodę na kontakt w celu przedstawienia oferty członkostwa w PIPL.<br>
                                Twoje dane są bezpieczne i przetwarzane zgodnie z RODO.
                            </p>
                        </div>
                    </form>
                </div>
            @endif

        </div>
    </div>
</section>

<footer class="bg-black text-gray-400 py-10 text-center text-sm">
    <div class="container mx-auto px-6">
        <p class="mb-2 text-white font-bold">Polska Izba Przedsiębiorców Lokalnych</p>
        <p>&copy; {{ date('Y') }} Wszelkie prawa zastrzeżone.</p>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if ($errors->any() || session('error') || session('success'))
        const formSection = document.getElementById('formularz');
        if (formSection) {
            formSection.scrollIntoView({ behavior: 'smooth' });
        }
        @endif
    });
</script>

</body>
</html>
