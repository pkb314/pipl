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
                            graphite: '#3F474F', // Primary
                            red: '#D71920',      // Accent
                            gray: '#C7C7C7',     // Light BG
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="text-pipl-graphite antialiased">

<header class="relative bg-pipl-graphite h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Biznesowe spotkanie" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-pipl-graphite/90"></div>
    </div>

    <div class="relative z-10 container mx-auto px-6 text-center text-white max-w-4xl">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            Nie jesteśmy klubem towarzyskim.<br>
            Jesteśmy <span class="text-red-500">narzędziem rozwoju</span> Twojego biznesu.
        </h1>
        <p class="text-xl md:text-2xl mb-10 text-gray-300 font-light">
            Dołącz do ogólnopolskiej organizacji, która realnie wspiera przedsiębiorców – od mediacji sądowych po ekspansję zagraniczną.
        </p>
        <a href="#formularz" class="inline-block bg-pipl-red hover:bg-red-700 text-white font-bold py-4 px-8 rounded-lg text-lg transition duration-300 shadow-lg transform hover:-translate-y-1">
            Dołącz do 1000+ przedsiębiorców
        </a>
        <p class="mt-4 text-sm text-gray-400 uppercase tracking-widest">W biznesie samemu jest najdrożej</p>
    </div>
</header>

<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-pipl-graphite">Dlaczego Twoja firma tego potrzebuje?</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-12">
            <div class="text-center p-6 border border-gray-100 rounded-xl hover:shadow-xl transition duration-300">
                <div class="bg-pipl-graphite text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">1</div>
                <h3 class="text-xl font-bold mb-4">Wiedza wcześniej</h3>
                <p class="text-gray-600">Dowiaduj się o zmianach prawnych, dotacjach i trendach zanim zrobi to Twoja konkurencja. Bądź krok przed rynkiem.</p>
            </div>
            <div class="text-center p-6 border border-gray-100 rounded-xl hover:shadow-xl transition duration-300">
                <div class="bg-pipl-graphite text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">2</div>
                <h3 class="text-xl font-bold mb-4">Kontakty szybciej</h3>
                <p class="text-gray-600">Skończ z zimnymi telefonami. Buduj relacje w gronie zweryfikowanych partnerów biznesowych.</p>
            </div>
            <div class="text-center p-6 border border-gray-100 rounded-xl hover:shadow-xl transition duration-300">
                <div class="bg-pipl-graphite text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">3</div>
                <h3 class="text-xl font-bold mb-4">Decyzje pewniej</h3>
                <p class="text-gray-600">Nie ryzykuj samotnie. Korzystaj z doświadczenia mentorów i wsparcia ekspertów Izby.</p>
            </div>
        </div>


    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-10 md:mb-0 pr-0 md:pr-12">
            <h2 class="text-3xl font-bold mb-6 text-pipl-graphite">Rozwiązujemy Twoje problemy</h2>
            <ul class="space-y-6">
                <li class="flex items-start">
                    <svg class="w-6 h-6 text-pipl-red mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <div>
                        <strong class="block text-lg">Spory bez sądu</strong>
                        <p class="text-gray-600">Oszczędź lata i pieniądze dzięki naszym tanim i szybkim mediacjom gospodarczym.</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <svg class="w-6 h-6 text-pipl-red mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <div>
                        <strong class="block text-lg">Wsparcie w eksporcie</strong>
                        <p class="text-gray-600">Chcesz wyjść za granicę? Pomożemy Ci bezpiecznie wejść na nowe rynki.</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <svg class="w-6 h-6 text-pipl-red mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <div>
                        <strong class="block text-lg">Dostęp do pieniędzy</strong>
                        <p class="text-gray-600">Regularne informacje o dotacjach, funduszach i optymalizacji podatkowej.</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="md:w-1/2">
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Współpraca biznesowa" class="rounded-lg shadow-2xl">
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-2xl font-bold mb-10 text-gray-500">Zrzeszamy liderów każdej skali</h2>
        <div class="flex flex-wrap justify-center gap-4">
            <span class="px-6 py-3 bg-gray-100 rounded-full text-pipl-graphite font-semibold">Mikro firmy</span>
            <span class="px-6 py-3 bg-gray-100 rounded-full text-pipl-graphite font-semibold">Firmy Rodzinne</span>
            <span class="px-6 py-3 bg-gray-100 rounded-full text-pipl-graphite font-semibold">Startupy</span>
            <span class="px-6 py-3 bg-gray-100 rounded-full text-pipl-graphite font-semibold">Korporacje</span>
        </div>
    </div>
</section>

<section id="formularz" class="py-12 md:py-20 bg-pipl-graphite text-white">
    <div class="container mx-auto px-4 md:px-6 max-w-4xl">

        <div class="text-center mb-8 md:mb-12">
            <h2 class="text-2xl md:text-4xl font-bold mb-3 md:mb-4">Przestań przepłacać za błędy.</h2>
            <p class="text-lg md:text-xl text-gray-300">Zadbaj o bezpieczeństwo swojej firmy już dziś.</p>
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
                        <p class="text-xs text-gray-400 text-center mt-4">Twoje dane są bezpieczne. Przetwarzamy je zgodnie z RODO w celu kontaktu.</p>
                    </div>
                </form>
        </div>
    </div>
</section>

<footer class="bg-black text-white py-8 text-center text-sm">
    &copy; {{ date('Y') }} Polska Izba Przedsiębiorców Lokalnych. Wszelkie prawa zastrzeżone.
</footer>

</body>
</html>
