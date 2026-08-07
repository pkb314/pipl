@extends('layouts.legal')

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="flex items-center justify-between">
        <div>
            <p class="rule-label text-xs font-black uppercase text-pipl-red">Panel administracyjny</p>
            <h1 class="mt-4 text-3xl font-black">Dodaj zgłoszenie</h1>
        </div>
        <a href="{{ route('admin.leads') }}" class="rounded border border-pipl-line bg-white px-4 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">
            Powrót
        </a>
    </div>

    @if ($errors->any())
        <div class="mt-6 border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <ul class="list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.leads.store') }}" class="mt-8 grid grid-cols-2 gap-4">
        @csrf
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Imię</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Jan">
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Nazwisko</label>
            <input type="text" name="surname" value="{{ old('surname') }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Kowalski">
        </div>
        <div class="col-span-2">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Gmina</label>
            <select id="gmina-select" required></select>
            <input type="hidden" name="gmina" id="gmina-hidden" value="{{ old('gmina') }}">
        </div>
        <div class="col-span-2">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Gmina, którą chcesz reprezentować i dlaczego właśnie ta gmina</label>
            <textarea name="gmina_reason" rows="3" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100 resize-none" placeholder="Dlaczego właśnie ta gmina?">{{ old('gmina_reason') }}</textarea>
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Telefon</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="+48 000 000 000">
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="adres@firma.pl">
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Branża firmy</label>
            <input type="text" name="business_sector" value="{{ old('business_sector') }}" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Np. gastronomia, budownictwo">
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">NIP firmy</label>
            <input type="text" name="nip" value="{{ old('nip') }}" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="NIP">
        </div>

        @php
            $radioQuestions = [
                'knows_entrepreneurs' => ['label' => 'Jak dobrze znasz lokalnych przedsiębiorców w swojej gminie?', 'options' => [
                    'Znam większość z nich osobiście', 'Znam część z nich', 'Dopiero zaczynam budować sieć kontaktów', 'Nie mam takich kontaktów',
                ]],
                'own_business' => ['label' => 'Czy sam/a prowadzisz lub prowadziłeś/aś działalność gospodarczą?', 'options' => [
                    'Tak, aktywnie prowadzę', 'Prowadziłem/am w przeszłości', 'Nie, ale pracuję blisko środowiska biznesowego', 'Nie mam takiego doświadczenia', 'Mam zawieszoną działalność',
                ]],
                'meeting_new_people' => ['label' => 'Gdy spotykasz nową osobę w środowisku biznesowym, jak zwykle postępujesz?', 'options' => [
                    'Inicjuję rozmowę i wychodzę z propozycją współpracy', 'Chętnie rozmawiam, gdy ktoś zagadnie', 'Wolę obserwować i stopniowo wchodzić w relacje', 'Networking jest dla mnie trudny',
                ]],
                'organized_events' => ['label' => 'Czy organizowałeś/aś kiedyś spotkania, eventy lub zebrania — nawet nieformalne?', 'options' => [
                    'Tak, regularnie i na większą skalę', 'Tak, kilka razy', 'Raz lub dwa, przy okazji', 'Nie organizowałem/am',
                ]],
                'handling_refusal' => ['label' => 'Jak reagujesz, gdy ktoś odmawia lub nie jest zainteresowany Twoją propozycją?', 'options' => [
                    'Akceptuję spokojnie i wracam po czasie', 'Trochę mnie to frustruje, ale daję radę', 'Trudno mi po odmowie wrócić do tej osoby', 'Odmowa mocno mnie zniechęca',
                ]],
                'local_government_contacts' => ['label' => 'Czy masz kontakty lub relacje z lokalnym samorządem, urzędem gminy?', 'options' => [
                    'Tak, aktywnie współpracuję lub współpracowałem/am', 'Znam kilka osób z urzędu', 'Nie mam relacji, ale nie mam też oporów', 'Unikam kontaktów z urzędami',
                ]],
                'working_style' => ['label' => 'Jak opisałbyś/abyś swój styl działania?', 'options' => [
                    'Działam z własnej inicjatywy, nie czekam na instrukcje', 'Dobrze mi z ramowym planem i swobodą wykonania', 'Wolę mieć szczegółowe wytyczne co do każdego kroku', 'Dobrze mi w rolach ściśle określonych z zewnątrz',
                ]],
                'weekly_time' => ['label' => 'Ile czasu tygodniowo możesz realistycznie poświęcić na tę rolę?', 'options' => [
                    '3–5 godzin lub więcej', '1–3 godziny tygodniowo', 'Kilkadziesiąt minut, przy okazji innych aktywności', 'Trudno mi to teraz ocenić',
                ]],
                'confidentiality' => ['label' => 'Czy zdarzało Ci się zachować w tajemnicy informacje powierzone przez kogoś - nawet pod presją?', 'options' => [
                    'Tak, dyskrecja to dla mnie podstawa', 'Zazwyczaj tak, choć nie zawsze jest łatwo', 'Nie zawsze - czasem czuję potrzebę podzielenia się', 'Rzadko kiedy udaje mi się utrzymać tajemnicę',
                ]],
                'conflicts' => ['label' => 'Czy masz aktywne konflikty lub napięcia w lokalnym środowisku biznesowym?', 'options' => [
                    'Nie, mam dobre relacje ze wszystkimi', 'Są drobne tarcia, ale nic poważnego', 'Jest kilka trudnych relacji, nad którymi pracuję', 'Tak, mam poważny konflikt z kimś w środowisku',
                ]],
            ];
        @endphp

        @foreach ($radioQuestions as $field => $q)
            <div class="col-span-2">
                <label class="mb-2 block text-sm font-bold text-pipl-graphite">{{ $q['label'] }}</label>
                <div class="space-y-2">
                    @foreach ($q['options'] as $option)
                        <label class="flex items-start gap-3 rounded border border-pipl-line bg-pipl-paper px-4 py-3 text-sm font-semibold text-pipl-graphite">
                            <input type="radio" name="{{ $field }}" value="{{ $option }}" @checked(old($field) === $option) class="mt-1 text-pipl-red focus:ring-pipl-red">
                            {{ $option }}
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="col-span-2">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Co motywuje Cię do objęcia tej roli? (możesz zaznaczyć kilka odpowiedzi)</label>
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
                    <input type="text" name="motivation_other" value="{{ old('motivation_other') }}" class="w-full rounded border border-pipl-line bg-white p-3 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Jeśli zaznaczyłeś/aś „Inne", wpisz co...">
                </div>
            </div>
        </div>

        <div class="col-span-2">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Dlaczego akurat Ty powinieneś/powinnaś zostać Koordynatorem Gminnym PIPL w swojej gminie? (2–5 zdań)</label>
            <textarea name="why_you" rows="3" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100 resize-none" placeholder="Twoja odpowiedź...">{{ old('why_you') }}</textarea>
        </div>
        <div class="col-span-2">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Czy jest coś, o czym chciałbyś/chciałabyś nas poinformować przed rozmową?</label>
            <textarea name="additional_info" rows="3" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100 resize-none" placeholder="Twoja odpowiedź...">{{ old('additional_info') }}</textarea>
        </div>

        @if (auth()->user()->canAssignLeads())
        <div class="col-span-2">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Przypisz do</label>
            <select name="assigned_to" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100">
                <option value="">Nie przypisuj</option>
                @foreach ($handlowcy as $h)
                    <option value="{{ $h->id }}" @selected(old('assigned_to') == $h->id)>{{ $h->name }} ({{ $h->role === 'glowny_handlowiec' ? 'Główny handlowiec' : 'Handlowiec' }})</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="col-span-2">
            <button type="submit" class="w-full rounded bg-pipl-red px-6 py-4 text-base font-black text-white transition hover:bg-pipl-redDark">
                Dodaj zgłoszenie
            </button>
        </div>
    </form>
</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gminaSelect = new TomSelect('#gmina-select', {
        valueField: 'value',
        labelField: 'label',
        searchField: ['value', 'label'],
        create: false,
        maxOptions: 30,
        placeholder: 'Nazwa gminy',
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
<style>
    .ts-wrapper { width: 100%; border-radius: 0.25rem; border: 1px solid #D9DDD9; background: #F6F4EF; }
    .ts-wrapper:focus-within { border-color: #A8242D; box-shadow: 0 0 0 4px rgba(168, 36, 45, 0.1); }
    .ts-wrapper .ts-control { border: none; background: transparent; box-shadow: none; padding: 1rem; font-size: 1rem; border-radius: 0; outline: none; }
    .ts-wrapper .ts-control .ts-input::placeholder { color: #65727C; }
    .ts-wrapper .ts-dropdown { border: 1px solid #D9DDD9; background: #fff; border-radius: 0; }
    .ts-wrapper .ts-dropdown .option { padding: 0.75rem 1rem; font-size: 0.875rem; }
    .ts-wrapper .ts-dropdown .option.selected { background: #A8242D; color: #fff; }
    .ts-wrapper .ts-dropdown .option:hover { background: #F6F4EF; }
</style>
@endsection
