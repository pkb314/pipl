@extends('layouts.legal', ['title' => 'Regulamin i statut - Polska Izba Przedsiębiorców Lokalnych'])

@section('content')
    <header class="border border-pipl-line bg-white p-6 md:p-8">
        <p class="text-sm font-black uppercase text-pipl-red">Dokumenty organizacji</p>
        <h1 class="mt-3 text-3xl font-black md:text-5xl">Statut, regulamin i zasady członkostwa</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-gray-600">
            W tej sekcji znajdują się dokumenty określające zasady działania Polskiej Izby Przedsiębiorców Lokalnych, prawa i obowiązki członków oraz podstawowe warunki korzystania z usług Izby.
        </p>
    </header>

    <section class="mt-6 grid gap-4 md:grid-cols-2">
        <div class="border border-pipl-line bg-white p-6">
            <h2 class="text-xl font-black">Dane organizacji</h2>
            <dl class="mt-4 space-y-2 text-sm leading-6 text-gray-700">
                <div><dt class="inline font-black">Nazwa:</dt> <dd class="inline">{{ config('organization.name') }}</dd></div>
                <div><dt class="inline font-black">Forma prawna:</dt> <dd class="inline">{{ config('organization.legal_form') }}</dd></div>
                <div><dt class="inline font-black">Adres siedziby:</dt> <dd class="inline">{{ config('organization.address') }}</dd></div>
                <div><dt class="inline font-black">KRS:</dt> <dd class="inline">{{ config('organization.krs') }}</dd></div>
                <div><dt class="inline font-black">NIP:</dt> <dd class="inline">{{ config('organization.nip') }}</dd></div>
                <div><dt class="inline font-black">REGON:</dt> <dd class="inline">{{ config('organization.regon') }}</dd></div>
                <div><dt class="inline font-black">Data rejestracji:</dt> <dd class="inline">{{ config('organization.registration_date') }}</dd></div>
            </dl>
        </div>
        <div class="border border-pipl-line bg-white p-6">
            <h2 class="text-xl font-black">Płatności online</h2>
            <p class="mt-4 leading-7 text-gray-600">
                Płatności online mogą być obsługiwane przez PayPro S.A., ul. Pastelowa 8, 60-198 Poznań, operatora serwisu Przelewy24. Przed dokonaniem płatności użytkownik otrzymuje informację o jej kwocie, walucie i tytule.
            </p>
        </div>
        <div class="border border-pipl-line bg-white p-6">
            <h2 class="text-xl font-black">Przedmiot płatności</h2>
            <p class="mt-4 leading-7 text-gray-600">
                Płatności mogą dotyczyć składek członkowskich, udziału w wydarzeniach, szkoleń lub innych świadczeń wskazanych przez Izbę przed złożeniem zamówienia.
            </p>
        </div>
        <div class="border border-pipl-line bg-white p-6">
            <h2 class="text-xl font-black">Reklamacje i odstąpienie</h2>
            <p class="mt-4 leading-7 text-gray-600">
                Reklamacje dotyczące świadczeń Izby należy kierować kanałem kontaktowym wskazanym przy danym świadczeniu. Uprawnienia konsumenta, w tym prawo odstąpienia od umowy, stosuje się zgodnie z obowiązującymi przepisami.
            </p>
        </div>
    </section>

    @php
        $lines = preg_split('/\R/u', trim($document));
    @endphp

    <article class="legal-copy mt-8 border border-pipl-line bg-white p-6 md:p-10">
        @foreach ($lines as $line)
            @php
                $line = trim($line);

                if ($line === '' || preg_match('/^\d+$/', $line) || preg_match('/^--\s*\d+\s+of\s+\d+\s*--$/i', $line)) {
                    continue;
                }

                $isChapter = str_starts_with($line, 'ROZDZIAŁ');
                $isParagraph = str_starts_with($line, '§');
                $isMainTitle = in_array($line, [
                    'STATUT IZBY GOSPODARCZEJ',
                    'REGULAMIN CZŁONKOSTWA',
                    'DEKLARACJA CZŁONKOSTWA',
                ], true);
                $isUpperHeadline = !$isMainTitle
                    && mb_strlen($line) < 80
                    && preg_match('/[A-ZĄĆĘŁŃÓŚŹŻ]/u', $line)
                    && mb_strtoupper($line, 'UTF-8') === $line
                    && !preg_match('/^\d+\)|^[a-z]\)/u', $line);
            @endphp

            @if ($isMainTitle)
                <h2 class="document-title">{{ $line }}</h2>
            @elseif ($isChapter)
                <h2>{{ $line }}</h2>
            @elseif ($isParagraph || $isUpperHeadline)
                <h3>{{ $line }}</h3>
            @else
                <p>{{ $line }}</p>
            @endif
        @endforeach
    </article>
@endsection
