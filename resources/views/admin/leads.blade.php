@extends('layouts.legal')

@section('content')
<div>
    <div class="flex items-center justify-between">
        <div>
            <p class="rule-label text-xs font-black uppercase text-pipl-red">Panel administracyjny</p>
            <h1 class="mt-4 text-3xl font-black">Zgłoszenia</h1>
            <p class="mt-2 text-sm text-pipl-steel">{{ $leads->count() }} zgłoszeń łącznie</p>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="rounded border border-pipl-line bg-white px-4 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper hover:text-pipl-red">
                Wyloguj
            </button>
        </form>
    </div>

    <form method="GET" action="{{ route('admin.leads') }}" class="mt-8 space-y-4">
        <div>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Szukaj po imieniu, nazwisku, firmie, e-mailu, telefonie..."
                class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100"
            >
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-pipl-steel">Województwo</label>
                <select id="filter-wojewodztwo" name="wojewodztwo">
                    <option value="">Wszystkie</option>
                    @foreach ($wojewodztwa as $w)
                        <option value="{{ $w }}" @selected(request('wojewodztwo') === $w)>{{ $w }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-pipl-steel">Powiat</label>
                <select id="filter-powiat" name="powiat">
                    <option value="">Wszystkie</option>
                    @foreach ($powiaty as $p)
                        <option value="{{ $p }}" @selected(request('powiat') === $p)>{{ $p }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-pipl-steel">Gmina</label>
                <select id="filter-gmina" name="gmina">
                    <option value="">Wszystkie</option>
                    @foreach ($gminy as $g)
                        <option value="{{ $g }}" @selected(request('gmina') === $g)>{{ $g }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded bg-pipl-red px-6 py-3 text-sm font-bold text-white transition hover:bg-pipl-redDark">
                Filtruj
            </button>
            @if (request()->hasAny(['search', 'wojewodztwo', 'powiat', 'gmina']))
                <a href="{{ route('admin.leads') }}" class="rounded border border-pipl-line bg-white px-6 py-3 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">
                    Wyczyść filtry
                </a>
            @endif
        </div>
    </form>

    <div class="mt-8 overflow-x-auto">
        <table class="w-full min-w-[900px] border border-pipl-line bg-white text-sm">
            <thead>
                <tr class="border-b border-pipl-line bg-pipl-paper text-left text-xs font-black uppercase tracking-wide text-pipl-steel">
                    <th class="px-4 py-3">Data</th>
                    <th class="px-4 py-3">Imię i nazwisko</th>
                    <th class="px-4 py-3">Firma</th>
                    <th class="px-4 py-3">Gmina</th>
                    <th class="px-4 py-3">Powiat</th>
                    <th class="px-4 py-3">Województwo</th>
                    <th class="px-4 py-3">E-mail</th>
                    <th class="px-4 py-3">Telefon</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pipl-line">
                @forelse ($leads as $lead)
                    <tr class="transition hover:bg-pipl-porcelain">
                        <td class="whitespace-nowrap px-4 py-3 text-pipl-steel">{{ $lead->created_at->format('Y-m-d H:i') }}</td>
                        <td class="whitespace-nowrap px-4 py-3 font-bold">{{ $lead->name }} {{ $lead->surname }}</td>
                        <td class="px-4 py-3 text-pipl-graphite">{{ $lead->company }}</td>
                        <td class="px-4 py-3 text-pipl-graphite">{{ $lead->gmina }}</td>
                        <td class="px-4 py-3 text-pipl-graphite">{{ $lead->powiat ?? '—' }}</td>
                        <td class="px-4 py-3 text-pipl-graphite">{{ $lead->wojewodztwo ?? '—' }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-pipl-graphite">{{ $lead->email }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-pipl-graphite">{{ $lead->phone }}</td>
                        <td class="whitespace-nowrap px-4 py-3">
                            @if ($lead->status === 'verified')
                                <span class="inline-block rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-green-800">Weryfikacja OK</span>
                            @elseif ($lead->status === 'failed')
                                <span class="inline-block rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-800">Błąd</span>
                            @else
                                <span class="inline-block rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-800">Oczekuje</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-12 text-center text-pipl-steel">Brak zgłoszeń.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tsConfig = {
        maxOptions: 200,
        placeholder: 'Wszystkie',
        allowEmptyOption: true,
        plugins: ['remove_button'],
    };

    const filterWoj = new TomSelect('#filter-wojewodztwo', {
        ...tsConfig,
        onChange: function(value) {
            const powiatSelect = document.getElementById('filter-powiat');
            const gminaSelect = document.getElementById('filter-gmina');

            powiatSelect.innerHTML = '<option value="">Wszystkie</option>';
            gminaSelect.innerHTML = '<option value="">Wszystkie</option>';

            if (filterPowiat.tomselect) filterPowiat.tomselect.clear();
            if (filterGmina.tomselect) filterGmina.tomselect.clear();

            if (!value) {
                fetch('/api/powiaty').then(r => r.json()).then(data => {
                    data.forEach(p => {
                        const opt = document.createElement('option');
                        opt.value = p; opt.text = p;
                        powiatSelect.appendChild(opt);
                    });
                    filterPowiat.tomupdate && filterPowiat.tomupdate();
                });
                return;
            }

            fetch('/api/powiaty?wojewodztwo=' + encodeURIComponent(value))
                .then(r => r.json()).then(data => {
                    data.forEach(p => {
                        const opt = document.createElement('option');
                        opt.value = p; opt.text = p;
                        powiatSelect.appendChild(opt);
                    });
                    filterPowiat.tomupdate && filterPowiat.tomupdate();
                });
        }
    });

    const filterPowiat = new TomSelect('#filter-powiat', {
        ...tsConfig,
        onChange: function(value) {
            const gminaSelect = document.getElementById('filter-gmina');
            gminaSelect.innerHTML = '<option value="">Wszystkie</option>';

            if (filterGmina.tomselect) filterGmina.tomselect.clear();

            if (!value) {
                fetch('/api/gminy-list').then(r => r.json()).then(data => {
                    data.forEach(g => {
                        const opt = document.createElement('option');
                        opt.value = g; opt.text = g;
                        gminaSelect.appendChild(opt);
                    });
                    filterGmina.tomupdate && filterGmina.tomupdate();
                });
                return;
            }

            fetch('/api/gminy-list?powiat=' + encodeURIComponent(value))
                .then(r => r.json()).then(data => {
                    data.forEach(g => {
                        const opt = document.createElement('option');
                        opt.value = g; opt.text = g;
                        gminaSelect.appendChild(opt);
                    });
                    filterGmina.tomupdate && filterGmina.tomupdate();
                });
        }
    });

    const filterGmina = new TomSelect('#filter-gmina', tsConfig);

    function syncTomSelect(selectEl) {
        if (selectEl.tomselect) selectEl.tomselect.destroy();
        const ts = new TomSelect(selectEl, tsConfig);
        selectEl.tomupdate = () => ts.destroy() || (selectEl.tomselect = new TomSelect(selectEl, tsConfig));
    }

    function reinitTomSelects() {
        syncTomSelect(document.getElementById('filter-wojewodztwo'));
        syncTomSelect(document.getElementById('filter-powiat'));
        syncTomSelect(document.getElementById('filter-gmina'));
    }

    // Re-sync after filter submit preserves state
    setTimeout(reinitTomSelects, 50);
});
</script>
<style>
    .ts-wrapper {
        width: 100%;
        border-radius: 0.25rem;
        border: 1px solid #D9DDD9;
        background: #F6F4EF;
    }
    .ts-wrapper:focus-within {
        border-color: #A8242D;
        box-shadow: 0 0 0 4px rgba(168, 36, 45, 0.1);
    }
    .ts-wrapper .ts-control {
        border: none;
        background: transparent;
        box-shadow: none;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        border-radius: 0;
        outline: none;
    }
    .ts-wrapper .ts-dropdown {
        border: 1px solid #D9DDD9;
        background: #fff;
        border-radius: 0;
    }
    .ts-wrapper .ts-dropdown .option {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
    .ts-wrapper .ts-dropdown .option.selected {
        background: #A8242D;
        color: #fff;
    }
    .ts-wrapper .ts-dropdown .option:hover {
        background: #F6F4EF;
    }
</style>
@endsection
