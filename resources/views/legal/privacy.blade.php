@extends('layouts.legal', ['title' => 'Polityka prywatności - Polska Izba Przedsiębiorców Lokalnych'])

@section('content')
    <article class="border border-pipl-line bg-white p-6 md:p-10">
        <p class="text-sm font-black uppercase text-pipl-red">Polityka prywatności</p>
        <h1 class="mt-3 text-3xl font-black md:text-5xl">Ochrona danych osobowych</h1>
        <p class="mt-5 text-lg leading-8 text-gray-600">
            Polska Izba Przedsiębiorców Lokalnych przetwarza dane osobowe w sposób ograniczony do celów kontaktowych, organizacyjnych i rozliczeniowych. Poniżej przedstawiamy zasady przetwarzania danych oraz prawa osób, których dane dotyczą.
        </p>

        <div class="legal-copy mt-8">
            <h2>1. Administrator danych</h2>
            <p>Administratorem danych osobowych jest {{ config('organization.name') }}, {{ config('organization.legal_form') }}, KRS {{ config('organization.krs') }}, NIP {{ config('organization.nip') }}, REGON {{ config('organization.regon') }}, z siedzibą pod adresem: {{ config('organization.address') }}. W sprawach dotyczących danych osobowych można kontaktować się z Izbą przez formularz kontaktowy lub oficjalny kanał korespondencji wskazany przez Izbę.</p>

            <h2>2. Zakres przetwarzanych danych</h2>
            <p>W formularzu kontaktowym przetwarzamy imię, nazwisko, nazwę firmy, numer telefonu i adres e-mail. W przypadku płatności możemy przetwarzać także identyfikator transakcji, kwotę, walutę, opis płatności, status płatności oraz dane techniczne niezbędne do obsługi transakcji.</p>

            <h2>3. Cele i podstawy prawne</h2>
            <p>Dane przetwarzamy w celu obsługi zgłoszenia, kontaktu w sprawie członkostwa, potwierdzenia adresu e-mail, obsługi płatności oraz realizacji obowiązków prawnych i księgowych. Podstawą przetwarzania jest podjęcie działań na żądanie osoby, której dane dotyczą, realizacja obowiązków prawnych oraz prawnie uzasadniony interes administratora polegający na prowadzeniu komunikacji i zabezpieczeniu roszczeń.</p>

            <h2>4. Odbiorcy danych</h2>
            <p>Dane mogą być przekazywane podmiotom świadczącym usługi IT, pocztowe, księgowe, CRM oraz operatorowi płatności. W przypadku płatności online odbiorcą danych jest PayPro S.A., ul. Pastelowa 8, 60-198 Poznań, działająca jako operator Przelewy24.</p>

            <h2>5. Okres przechowywania</h2>
            <p>Dane z formularza kontaktowego przechowujemy przez okres potrzebny do obsługi zgłoszenia i dalszej komunikacji. Dane związane z płatnościami i rozliczeniami przechowujemy przez okres wymagany przepisami prawa oraz czas niezbędny do zabezpieczenia lub dochodzenia roszczeń.</p>

            <h2>6. Prawa osoby, której dane dotyczą</h2>
            <p>Przysługuje Ci prawo dostępu do danych, sprostowania, usunięcia, ograniczenia przetwarzania, przenoszenia danych, sprzeciwu oraz wniesienia skargi do Prezesa Urzędu Ochrony Danych Osobowych.</p>

            <h2>7. Dobrowolność podania danych</h2>
            <p>Podanie danych jest dobrowolne, ale niezbędne do obsługi zgłoszenia, kontaktu lub płatności. Brak podania wymaganych danych może uniemożliwić realizację danej czynności.</p>

            <h2>8. Płatności elektroniczne</h2>
            <p>Płatności online mogą być obsługiwane przez Przelewy24. Po rozpoczęciu płatności użytkownik może zostać przekierowany do serwisu operatora płatności, gdzie transakcja jest obsługiwana zgodnie z regulaminem i polityką prywatności operatora.</p>
        </div>
    </article>
@endsection
