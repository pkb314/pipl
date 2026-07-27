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
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Nazwa firmy</label>
            <input type="text" name="company" value="{{ old('company') }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Nazwa przedsiębiorstwa">
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Adres</label>
            <input type="text" name="adres" value="{{ old('adres') }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="Ulica, numer, kod pocztowy, miasto">
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Gmina</label>
            <select id="gmina-select" required></select>
            <input type="hidden" name="gmina" id="gmina-hidden" value="{{ old('gmina') }}">
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Telefon</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="+48 000 000 000">
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100" placeholder="adres@firma.pl">
        </div>
        <div class="col-span-2">
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Napisz coś o sobie</label>
            <textarea name="about" rows="4" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100 resize-none" placeholder="Opisz działalność, doświadczenie...">{{ old('about') }}</textarea>
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
