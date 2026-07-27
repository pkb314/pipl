@extends('layouts.legal')

@section('content')
<div>
    <div class="flex items-center justify-between">
        <div>
            <p class="rule-label text-xs font-black uppercase text-pipl-red">Panel administracyjny</p>
            <h1 class="mt-4 text-3xl font-black">Użytkownicy</h1>
            <p class="mt-2 text-sm text-pipl-steel">{{ $users->count() }} użytkowników</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.users.create') }}" class="rounded bg-pipl-red px-4 py-2 text-sm font-bold text-white transition hover:bg-pipl-redDark">
                Dodaj użytkownika
            </a>
            <a href="{{ route('admin.leads') }}" class="rounded border border-pipl-line bg-white px-4 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">
                Zgłoszenia
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mt-4 rounded border border-green-200 bg-green-50 p-4 text-sm text-green-800">{{ session('success') }}</div>
    @endif

    <div class="mt-8 overflow-x-auto">
        <table class="w-full min-w-[600px] border border-pipl-line bg-white text-sm">
            <thead>
                <tr class="border-b border-pipl-line bg-pipl-paper text-left text-xs font-black uppercase tracking-wide text-pipl-steel">
                    <th class="px-4 py-3">Nazwa</th>
                    <th class="px-4 py-3">E-mail</th>
                    <th class="px-4 py-3">Rola</th>
                    <th class="px-4 py-3">Utworzono</th>
                    <th class="px-4 py-3">Akcje</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pipl-line">
                @forelse ($users as $user)
                    <tr class="transition hover:bg-pipl-porcelain">
                        <td class="px-4 py-3 font-bold">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-pipl-graphite">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            @if ($user->role === 'admin')
                                <span class="inline-block rounded-full bg-pipl-red/10 px-3 py-1 text-xs font-bold text-pipl-red">Administrator</span>
                            @elseif ($user->role === 'glowny_handlowiec')
                                <span class="inline-block rounded-full bg-purple-50 px-3 py-1 text-xs font-bold text-purple-700">Główny Handlowiec</span>
                            @else
                                <span class="inline-block rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">Handlowiec</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-pipl-steel">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-xs font-bold text-pipl-red hover:underline">Edytuj</a>
                                @if ($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.delete', $user) }}" onsubmit="return confirm('Na pewno usunąć to konto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-red-600 hover:underline">Usuń</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-pipl-steel">Brak użytkowników.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
