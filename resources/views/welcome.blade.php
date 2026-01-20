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
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        html { scroll-behavior: smooth; }
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
            Zostań Członkiem
        </a>
    </div>
</nav>

<header class="relative pt-32 pb-20 md:pt-48 md:pb-32 bg-pipl-graphite text-white overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Profesjonalne biuro" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-b from-pipl-graphite/95 to-pipl-graphite"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 md:px-6 text-center max-w-5xl">
        <div class="inline-flex items-center gap-2 py-2 px-4 border border-gray-600 bg-white/5 rounded-full text-sm font-medium tracking-wide uppercase mb-8 backdrop-blur-sm">
            <span class="w-2 h-2 rounded-full bg-green-500"></span>
            Oficjalna Organizacja Samorządu Gospodarczego
        </div>

        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
            Skuteczna reprezentacja <br class="hidden md:block">
            Twoich interesów.
        </h1>

        <h2 class="text-xl md:text-3xl text-gray-200 font-light mb-8">
            Jesteśmy <span class="text-pipl-red font-bold">IZBĄ GOSPODARCZĄ</span> – Twoim partnerem w rozmowach z urzędami i gwarantem bezpieczeństwa prawnego.
        </h2>

        <p class="text-lg text-gray-400 font-light max-w-3xl mx-auto mb-10">
            Zapewniamy realne wsparcie dla mikro i małych przedsiębiorstw. Nie walcz z biurokracją w pojedynkę.
        </p>

        <div class="flex flex-col md:flex-row justify-center gap-4">
            <a href="#formularz" class="bg-pipl-red hover:bg-red-700 text-white font-bold py-4 px-10 rounded-lg text-lg transition duration-300 shadow-lg shadow-red-900/20 transform hover:-translate-y-1">
                Dołącz do Izby
            </a>
            <a href="#dlaczego" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold py-4 px-8 rounded-lg text-lg transition duration-300 backdrop-blur-sm">
                Dowiedz się więcej
            </a>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-700/50 flex flex-wrap justify-center gap-8 md:gap-16 text-gray-400 text-sm md:text-base">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-pipl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Zweryfikowani Członkowie</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-pipl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span>Współpraca z Urzędami</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-pipl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span>Siła Społeczności</span>
            </div>
        </div>
    </div>
</header>

<section id="dlaczego" class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-pipl-graphite mb-4">Siła w grupie, której potrzebujesz</h2>
            <p class="text-gray-600 text-lg">Samodzielna walka z biurokracją to strata czasu i pieniędzy. W Izbie Twój głos zyskuje rangę oficjalnego stanowiska.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 md:gap-12">
            <div class="group p-8 bg-gray-50 rounded-2xl border border-gray-100 hover:border-pipl-red/30 transition duration-300">
                <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                    <svg class="w-8 h-8 text-pipl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-pipl-graphite">Dialog z Urzędami</h3>
                <p class="text-gray-600 leading-relaxed">Skracamy dystans do urzędników. Jako Izba jesteśmy partnerem do rozmów dla samorządów, a nie petentem. Wspólnie rozwiązujemy problemy lokalne.</p>
            </div>

            <div class="group p-8 bg-gray-50 rounded-2xl border border-gray-100 hover:border-pipl-red/30 transition duration-300">
                <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                    <svg class="w-8 h-8 text-pipl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-pipl-graphite">Wiedza przed innymi</h3>
                <p class="text-gray-600 leading-relaxed">Zmiany w podatkach? Nowe wymogi prawne? Dowiadujesz się o nich pierwszy, w języku przedsiębiorcy, a nie prawnika. Unikasz kar i błędów.</p>
            </div>

            <div class="group p-8 bg-gray-50 rounded-2xl border border-gray-100 hover:border-pipl-red/30 transition duration-300">
                <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                    <svg class="w-8 h-8 text-pipl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-pipl-graphite">Lokalna współpraca</h3>
                <p class="text-gray-600 leading-relaxed">90% firm to MŚP. Łączymy Cię ze sprawdzonymi partnerami z Twojego regionu. Budujesz relacje biznesowe, które przynoszą zysk, a nie tylko wizytówki.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-100 border-y border-gray-200">
    <div class="container mx-auto px-4 md:px-6 text-center">
        <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-6">Reprezentujemy interesy</p>
        <div class="flex flex-wrap justify-center items-center gap-4 md:gap-8">
            <span class="px-5 py-2 bg-white rounded-full shadow-sm text-gray-700 font-medium">Mikro Przedsiębiorcy</span>
            <span class="px-5 py-2 bg-white rounded-full shadow-sm text-gray-700 font-medium">Firmy Rodzinne</span>
            <span class="px-5 py-2 bg-white rounded-full shadow-sm text-gray-700 font-medium">Usługi i Handel</span>
            <span class="px-5 py-2 bg-white rounded-full shadow-sm text-gray-700 font-medium">Lokalni Producenci</span>
        </div>
    </div>
</section>

<section id="formularz" class="py-16 md:py-24 bg-pipl-graphite text-white relative">
    <div class="container mx-auto px-4 md:px-6 max-w-4xl relative z-10">

        <div class="text-center mb-10 md:mb-14">
            <h2 class="text-2xl md:text-4xl font-bold mb-4">Zadbaj o przyszłość swojej firmy.</h2>
            <p class="text-lg text-gray-300">Wypełnij formularz. Skontaktujemy się i przedstawimy korzyści członkostwa w Izbie.</p>
        </div>

        <div class="bg-white text-gray-800 rounded-2xl shadow-2xl p-5 md:p-12">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('form.submit') }}" method="POST" class="grid grid-cols-2 gap-4 md:gap-6">
                @csrf

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold mb-2">Imię</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full p-4 text-base bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red"
                           placeholder="Jan"
                           required>
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold mb-2">Nazwisko</label>
                    <input type="text"
                           name="surname"
                           value="{{ old('surname') }}"
                           class="w-full p-4 text-base bg-gray-50 border @error('surname') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red"
                           placeholder="Kowalski"
                           required>
                    @error('surname')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold mb-2">Nazwa Firmy</label>
                    <input type="text"
                           name="company"
                           value="{{ old('company') }}"
                           class="w-full p-4 text-base bg-gray-50 border @error('company') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red"
                           placeholder="Twoja Firma Sp. z o.o."
                           required>
                    @error('company')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold mb-2">Telefon</label>
                    <input type="tel"
                           name="phone"
                           value="{{ old('phone') }}"
                           class="w-full p-4 text-base bg-gray-50 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red"
                           placeholder="+48 000 000 000"
                           required>
                    @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold mb-2">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full p-4 text-base bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:border-pipl-red"
                           placeholder="jan@firma.pl"
                           required>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2 mt-4">
                    <button type="submit" class="w-full bg-pipl-red hover:bg-red-700 text-white font-bold py-5 rounded-lg text-xl shadow-lg transition duration-300">
                        Wyślij zgłoszenie
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-4">Przetwarzamy dane zgodnie z polityką prywatności w celu rekrutacji członków.</p>
                </div>
            </form>
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
