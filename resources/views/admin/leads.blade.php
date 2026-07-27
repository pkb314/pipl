@extends('layouts.legal')

@section('content')
<div>
    <div class="flex items-center justify-between">
        <div>
            <p class="rule-label text-xs font-black uppercase text-pipl-red">Panel administracyjny</p>
            <h1 class="mt-4 text-3xl font-black">Zgłoszenia</h1>
            <p class="mt-2 text-sm text-pipl-steel">{{ $leads->total() }} zgłoszeń łącznie</p>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="rounded border border-pipl-line bg-white px-4 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper hover:text-pipl-red">
                Wyloguj
            </button>
        </form>
    </div>

    @if (session('success'))
        <div class="mt-4 rounded border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8 rounded border border-pipl-line bg-white p-6">
        <p class="text-xs font-black uppercase tracking-wide text-pipl-red">Sprawdź dostępność gminy</p>
        <p class="mt-1 text-sm text-pipl-steel">Wybierz gminę, aby sprawdzić czy jest już zajęta przez zaakceptowane zgłoszenie.</p>
        <div class="mt-4 flex gap-3">
            <div class="flex-1">
                <select id="check-gmina-select">
                    <option value="">Wybierz gminę...</option>
                </select>
                <input type="hidden" id="check-gmina-hidden">
            </div>
            <button type="button" id="check-gmina-btn" class="rounded bg-pipl-red px-6 py-2 text-sm font-bold text-white transition hover:bg-pipl-redDark">
                Sprawdź
            </button>
        </div>
        <div id="check-gmina-result" class="mt-4 hidden"></div>
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

        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
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
            <div>
                <label class="mb-1 block text-xs font-bold uppercase tracking-wide text-pipl-steel">Status</label>
                <select id="filter-status" name="status">
                    <option value="">Wszystkie</option>
                    <option value="zgłoszone" @selected(request('status') === 'zgłoszone')>Zgłoszone</option>
                    <option value="zaakceptowane" @selected(request('status') === 'zaakceptowane')>Zaakceptowane</option>
                    <option value="odrzucone" @selected(request('status') === 'odrzucone')>Odrzucone</option>
                </select>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded bg-pipl-red px-6 py-3 text-sm font-bold text-white transition hover:bg-pipl-redDark">
                Filtruj
            </button>
            @if (request()->hasAny(['search', 'wojewodztwo', 'powiat', 'gmina', 'status']))
                <a href="{{ route('admin.leads') }}" class="rounded border border-pipl-line bg-white px-6 py-3 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">
                    Wyczyść filtry
                </a>
            @endif
        </div>
    </form>

    <div class="mt-8 overflow-x-auto">
        <table class="w-full min-w-[1000px] border border-pipl-line bg-white text-sm">
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
                            <form method="POST" action="{{ route('admin.leads.update-status', $lead) }}" class="inline-flex items-center gap-2">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="rounded border border-pipl-line bg-white px-2 py-1 text-xs font-bold focus:border-pipl-red focus:outline-none focus:ring-2 focus:ring-red-100 @if($lead->status === 'zaakceptowane') text-green-800 bg-green-50 border-green-200 @elseif($lead->status === 'odrzucone') text-red-800 bg-red-50 border-red-200 @else text-amber-800 bg-amber-50 border-amber-200 @endif">
                                    <option value="zgłoszone" @selected($lead->status === 'zgłoszone')>Zgłoszone</option>
                                    <option value="zaakceptowane" @selected($lead->status === 'zaakceptowane')>Zaakceptowane</option>
                                    <option value="odrzucone" @selected($lead->status === 'odrzucone')>Odrzucone</option>
                                </select>
                            </form>
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

    @if ($leads->hasPages())
        <div class="mt-6 flex items-center justify-between">
            <p class="text-sm text-pipl-steel">
                Wyświetlanie {{ $leads->firstItem() }}–{{ $leads->lastItem() }} z {{ $leads->total() }}
            </p>
            <div class="flex gap-1">
                @if ($leads->onFirstPage())
                    <span class="rounded border border-pipl-line bg-pipl-paper px-3 py-2 text-sm font-bold text-pipl-steel opacity-50">&laquo; Poprzednia</span>
                @else
                    <a href="{{ $leads->previousPageUrl() }}" class="rounded border border-pipl-line bg-white px-3 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">&laquo; Poprzednia</a>
                @endif

                @foreach ($leads->getUrlRange(max(1, $leads->currentPage() - 2), min($leads->lastPage(), $leads->currentPage() + 2)) as $page => $url)
                    @if ($page == $leads->currentPage())
                        <span class="rounded bg-pipl-red px-3 py-2 text-sm font-bold text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="rounded border border-pipl-line bg-white px-3 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($leads->hasMorePages())
                    <a href="{{ $leads->nextPageUrl() }}" class="rounded border border-pipl-line bg-white px-3 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">Następna &raquo;</a>
                @else
                    <span class="rounded border border-pipl-line bg-pipl-paper px-3 py-2 text-sm font-bold text-pipl-steel opacity-50">Następna &raquo;</span>
                @endif
            </div>
        </div>
    @endif
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

    function reinitFilterTomSelects() {
        ['filter-wojewodztwo', 'filter-powiat', 'filter-gmina', 'filter-status'].forEach(id => {
            const el = document.getElementById(id);
            if (el && el.tomselect) el.tomselect.destroy();
        });

        const filterWoj = new TomSelect('#filter-wojewodztwo', {
            ...tsConfig,
            onChange: function(value) {
                const powiatSelect = document.getElementById('filter-powiat');
                const gminaSelect = document.getElementById('filter-gmina');
                powiatSelect.innerHTML = '<option value="">Wszystkie</option>';
                gminaSelect.innerHTML = '<option value="">Wszystkie</option>';
                if (powiatSelect.tomselect) powiatSelect.tomselect.clear();
                if (gminaSelect.tomselect) gminaSelect.tomselect.clear();

                if (!value) {
                    fetch('/api/powiaty').then(r => r.json()).then(data => {
                        data.forEach(p => { const o = document.createElement('option'); o.value = p; o.text = p; powiatSelect.appendChild(o); });
                        if (powiatSelect.tomselect) powiatSelect.tomselect.destroy();
                        new TomSelect(powiatSelect, {...tsConfig, onChange: filterWojCallbacks.powiat});
                    });
                    return;
                }
                fetch('/api/powiaty?wojewodztwo=' + encodeURIComponent(value)).then(r => r.json()).then(data => {
                    data.forEach(p => { const o = document.createElement('option'); o.value = p; o.text = p; powiatSelect.appendChild(o); });
                    if (powiatSelect.tomselect) powiatSelect.tomselect.destroy();
                    new TomSelect(powiatSelect, {...tsConfig, onChange: filterWojCallbacks.powiat});
                });
            }
        });

        const filterWojCallbacks = {
            powiat: function(value) {
                const gminaSelect = document.getElementById('filter-gmina');
                gminaSelect.innerHTML = '<option value="">Wszystkie</option>';
                if (gminaSelect.tomselect) gminaSelect.tomselect.clear();

                if (!value) {
                    fetch('/api/gminy-list').then(r => r.json()).then(data => {
                        data.forEach(g => { const o = document.createElement('option'); o.value = g; o.text = g; gminaSelect.appendChild(o); });
                        if (gminaSelect.tomselect) gminaSelect.tomselect.destroy();
                        new TomSelect(gminaSelect, tsConfig);
                    });
                    return;
                }
                fetch('/api/gminy-list?powiat=' + encodeURIComponent(value)).then(r => r.json()).then(data => {
                    data.forEach(g => { const o = document.createElement('option'); o.value = g; o.text = g; gminaSelect.appendChild(o); });
                    if (gminaSelect.tomselect) gminaSelect.tomselect.destroy();
                    new TomSelect(gminaSelect, tsConfig);
                });
            }
        };

        const filterPowiat = document.getElementById('filter-powiat');
        if (filterPowiat.tomselect) filterPowiat.tomselect.destroy();
        new TomSelect(filterPowiat, {...tsConfig, onChange: filterWojCallbacks.powiat});

        const filterGmina = document.getElementById('filter-gmina');
        if (filterGmina.tomselect) filterGmina.tomselect.destroy();
        new TomSelect(filterGmina, tsConfig);

        const filterStatus = document.getElementById('filter-status');
        if (filterStatus.tomselect) filterStatus.tomselect.destroy();
        new TomSelect(filterStatus, tsConfig);
    }

    reinitFilterTomSelects();

    // Gmina checker
    const checkGminaSelect = new TomSelect('#check-gmina-select', {
        valueField: 'value',
        labelField: 'label',
        searchField: ['value', 'label'],
        create: false,
        maxOptions: 30,
        placeholder: 'Wybierz gminę...',
        render: {
            option: function(data, escape) {
                return '<div class="py-2 px-3">' +
                    '<span class="font-bold">' + escape(data.value) + '</span>' +
                    ' <span class="text-pipl-steel text-sm">(pow. ' + escape(data.powiat) + ', woj. ' + escape(data.wojewodztwo) + ')</span>' +
                    '</div>';
            },
            item: function(data, escape) {
                return '<div>' + escape(data.value) + ' <span class="text-pipl-steel text-xs">(pow. ' + escape(data.powiat) + ', woj. ' + escape(data.wojewodztwo) + ')</span></div>';
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
            document.getElementById('check-gmina-hidden').value = value;
            document.getElementById('check-gmina-result').classList.add('hidden');
        }
    });

    document.getElementById('check-gmina-btn').addEventListener('click', function() {
        const gmina = document.getElementById('check-gmina-hidden').value;
        const resultDiv = document.getElementById('check-gmina-result');
        const btn = this;

        if (!gmina) {
            resultDiv.innerHTML = '<p class="text-sm text-pipl-steel">Wybierz gminę.</p>';
            resultDiv.classList.remove('hidden');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin inline-block h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Sprawdzam...';
        resultDiv.innerHTML = '<div class="flex items-center gap-3 text-sm text-pipl-steel"><svg class="animate-spin h-5 w-5 text-pipl-red" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Sprawdzam dostępność gminy...</div>';
        resultDiv.classList.remove('hidden');

        fetch('/admin/check-gmina?gmina=' + encodeURIComponent(gmina))
            .then(r => r.json())
            .then(data => {
                if (data.status === 'free') {
                    let html = '<div class="rounded border border-green-200 bg-green-50 p-4">' +
                        '<p class="text-sm font-bold text-green-800">Gmina ' + gmina + ' jest wolna.</p>' +
                        '<p class="mt-1 text-xs text-green-700">Brak zaakceptowanych zgłoszeń w tej gminie.</p>';

                    if (data.pending_count > 0) {
                        html += '<div class="mt-3 border-t border-green-200 pt-3">' +
                            '<p class="text-xs font-bold text-amber-700">Niezaakceptowane zgłoszenia: ' + data.pending_count + '</p>' +
                            '<button type="button" onclick="togglePendingList(this)" class="mt-1 text-xs font-bold text-pipl-red hover:underline">Pokaż</button>' +
                            '<div class="pending-list mt-2 hidden">';

                        data.pending_leads.forEach(function(lead) {
                            const statusBadge = lead.status === 'zgłoszone'
                                ? '<span class="inline-block rounded-full bg-amber-100 px-2 py-0.5 text-[10px] font-bold text-amber-700">Zgłoszone</span>'
                                : '<span class="inline-block rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-bold text-red-700">Odrzucone</span>';

                            html += '<div class="mb-2 rounded bg-white border border-pipl-line p-3 text-xs">' +
                                '<div class="flex items-center justify-between">' +
                                '<span class="font-bold text-pipl-ink">' + lead.name + '</span>' + statusBadge +
                                '</div>' +
                                '<p class="mt-1 text-pipl-graphite">' + lead.company + '</p>' +
                                '<p class="text-pipl-steel">' + lead.email + ' — ' + lead.created_at + '</p>' +
                                '</div>';
                        });

                        html += '</div></div>';
                    }

                    html += '</div>';
                    resultDiv.innerHTML = html;
                } else if (data.status === 'taken') {
                    resultDiv.innerHTML = '<div class="rounded border border-amber-200 bg-amber-50 p-4">' +
                        '<p class="text-sm font-bold text-amber-800">Gmina ' + gmina + ' jest zajęta.</p>' +
                        '<p class="mt-1 text-xs text-amber-700">Zaakceptowane zgłoszenie: <strong>' + data.lead.name + '</strong> (' + data.lead.company + ') — ' + data.lead.email + ', z ' + data.lead.created_at + '</p></div>';
                } else {
                    resultDiv.innerHTML = '<p class="text-sm text-pipl-steel">Podaj nazwę gminy.</p>';
                }
            })
            .catch(() => {
                resultDiv.innerHTML = '<div class="rounded border border-red-200 bg-red-50 p-4"><p class="text-sm font-bold text-red-800">Wystąpił błąd. Spróbuj ponownie.</p></div>';
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = 'Sprawdź';
            });
    });
});
</script>
<script>
function togglePendingList(btn) {
    const list = btn.parentElement.querySelector('.pending-list');
    const isHidden = list.classList.contains('hidden');
    list.classList.toggle('hidden');
    btn.textContent = isHidden ? 'Ukryj' : 'Pokaż';
}
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
