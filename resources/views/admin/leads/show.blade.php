@extends('layouts.legal')

@section('content')
<div>
    <div class="flex items-center justify-between">
        <div>
            <p class="rule-label text-xs font-black uppercase text-pipl-red">Panel administracyjny</p>
            <h1 class="mt-4 text-3xl font-black">{{ $lead->name }} {{ $lead->surname }}</h1>
            <p class="mt-2 text-sm text-pipl-steel">{{ $lead->company }}</p>
        </div>
        <a href="{{ route('admin.leads') }}" class="rounded border border-pipl-line bg-white px-4 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">
            Powrót do listy
        </a>
    </div>

    @if (session('success'))
        <div class="mt-4 rounded border border-green-200 bg-green-50 p-4 text-sm text-green-800">{{ session('success') }}</div>
    @endif

    <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_1fr]">
        {{-- Lewa strona: dane leada --}}
        <div>
            <form method="POST" action="{{ route('admin.leads.update', $lead) }}" class="space-y-4 rounded border border-pipl-line bg-white p-6">
                @csrf
                @method('PUT')
                <h2 class="text-lg font-black">Dane zgłoszenia</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-bold text-pipl-steel">Imię</label>
                        <input type="text" name="name" value="{{ old('name', $lead->name) }}" required class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold text-pipl-steel">Nazwisko</label>
                        <input type="text" name="surname" value="{{ old('surname', $lead->surname) }}" required class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Gmina</label>
                    <input type="text" name="gmina" value="{{ old('gmina', $lead->gmina) }}" required class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                    <p class="mt-1 text-xs text-pipl-steel">Powiat: {{ $lead->powiat ?? '—' }} | Województwo: {{ $lead->wojewodztwo ?? '—' }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-bold text-pipl-steel">Telefon</label>
                        <input type="tel" name="phone" value="{{ old('phone', $lead->phone) }}" required class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold text-pipl-steel">E-mail</label>
                        <input type="email" name="email" value="{{ old('email', $lead->email) }}" required class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-bold text-pipl-steel">Branża firmy</label>
                        <input type="text" name="business_sector" value="{{ old('business_sector', $lead->business_sector) }}" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold text-pipl-steel">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip', $lead->nip) }}" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Gmina, którą chcesz reprezentować i dlaczego właśnie ta gmina</label>
                    <textarea name="gmina_reason" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('gmina_reason', $lead->gmina_reason) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Jak dobrze znasz lokalnych przedsiębiorców w swojej gminie?</label>
                    <textarea name="knows_entrepreneurs" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('knows_entrepreneurs', $lead->knows_entrepreneurs) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Czy sam/a prowadzisz lub prowadziłeś/aś działalność gospodarczą?</label>
                    <textarea name="own_business" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('own_business', $lead->own_business) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Gdy spotykasz nową osobę w środowisku biznesowym, jak zwykle postępujesz?</label>
                    <textarea name="meeting_new_people" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('meeting_new_people', $lead->meeting_new_people) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Czy organizowałeś/aś kiedyś spotkania, eventy lub zebrania — nawet nieformalne?</label>
                    <textarea name="organized_events" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('organized_events', $lead->organized_events) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Jak reagujesz, gdy ktoś odmawia lub nie jest zainteresowany Twoją propozycją?</label>
                    <textarea name="handling_refusal" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('handling_refusal', $lead->handling_refusal) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Czy masz kontakty lub relacje z lokalnym samorządem, urzędem gminy?</label>
                    <textarea name="local_government_contacts" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('local_government_contacts', $lead->local_government_contacts) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Jak opisałbyś/abyś swój styl działania?</label>
                    <textarea name="working_style" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('working_style', $lead->working_style) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Ile czasu tygodniowo możesz realistycznie poświęcić na tę rolę?</label>
                    <textarea name="weekly_time" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('weekly_time', $lead->weekly_time) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Co motywuje Cię do objęcia tej roli?</label>
                    <textarea name="motivation" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('motivation', $lead->motivation) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Czy zdarzało Ci się zachować w tajemnicy informacje powierzone przez kogoś - nawet pod presją?</label>
                    <textarea name="confidentiality" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('confidentiality', $lead->confidentiality) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Czy masz aktywne konflikty lub napięcia w lokalnym środowisku biznesowym?</label>
                    <textarea name="conflicts" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('conflicts', $lead->conflicts) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Dlaczego akurat Ty powinieneś/powinnaś zostać Koordynatorem Gminnym PIPL w swojej gminie? (2–5 zdań)</label>
                    <textarea name="why_you" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('why_you', $lead->why_you) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Czy jest coś, o czym chciałbyś/chciałabyś nas poinformować przed rozmową?</label>
                    <textarea name="additional_info" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('additional_info', $lead->additional_info) }}</textarea>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Napisz coś o sobie</label>
                    <textarea name="about" rows="3" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none">{{ old('about', $lead->about) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1 block text-xs font-bold text-pipl-steel">Status</label>
                        <select name="status" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                            <option value="zgłoszone" @selected($lead->status === 'zgłoszone')>Zgłoszone</option>
                            <option value="zaakceptowane" @selected($lead->status === 'zaakceptowane')>Zaakceptowane</option>
                            <option value="odrzucone" @selected($lead->status === 'odrzucone')>Odrzucone</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-bold text-pipl-steel">Etap</label>
                        <select name="stage" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                            <option value="">—</option>
                            @foreach (\App\Http\Controllers\AdminController::STAGES as $s)
                                <option value="{{ $s }}" @selected($lead->stage === $s)>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if (auth()->user()->canAssignLeads())
                <div>
                    <label class="mb-1 block text-xs font-bold text-pipl-steel">Przypisz do</label>
                    <select name="assigned_to" class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none">
                        <option value="">Nie przypisuj</option>
                        @foreach ($handlowcy as $h)
                            <option value="{{ $h->id }}" @selected($lead->assigned_to === $h->id)>{{ $h->name }} ({{ $h->role === 'glowny_handlowiec' ? 'Główny handlowiec' : 'Handlowiec' }})</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="flex items-center gap-4 text-xs text-pipl-steel">
                    <span>Źródło: <strong>{{ $lead->source === 'reczne' ? 'Ręczne' : 'Formularz' }}</strong></span>
                    @if ($lead->user)
                        <span>Dodane przez: <strong>{{ $lead->user->name }}</strong></span>
                    @endif
                    @if ($lead->assignee)
                        <span>Przypisane do: <strong>{{ $lead->assignee->name }}</strong></span>
                    @endif
                    <span>Utworzone: {{ $lead->created_at->format('Y-m-d H:i') }}</span>
                </div>

                <button type="submit" class="rounded bg-pipl-red px-6 py-3 text-sm font-bold text-white transition hover:bg-pipl-redDark">
                    Zapisz zmiany
                </button>
            </form>
        </div>

        {{-- Prawa strona: komentarze --}}
        <div>
            <div class="rounded border border-pipl-line bg-white p-6">
                <h2 class="text-lg font-black">Komentarze ({{ $lead->comments->count() }})</h2>

                <div class="mt-4 space-y-3">
                    @forelse ($lead->comments as $comment)
                        <div class="rounded border border-pipl-line bg-pipl-porcelain p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-pipl-ink">{{ $comment->user->name }}</span>
                                <span class="text-xs text-pipl-steel">{{ $comment->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <p class="mt-2 text-sm text-pipl-graphite whitespace-pre-wrap">{{ $comment->body }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-pipl-steel">Brak komentarzy.</p>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('admin.leads.comment', $lead) }}" class="mt-4">
                    @csrf
                    <textarea name="body" rows="3" required placeholder="Dodaj komentarz..." class="w-full rounded border border-pipl-line bg-pipl-porcelain p-3 text-sm focus:border-pipl-red focus:outline-none resize-none"></textarea>
                    <button type="submit" class="mt-2 rounded bg-pipl-red px-6 py-2 text-sm font-bold text-white transition hover:bg-pipl-redDark">
                        Dodaj komentarz
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
