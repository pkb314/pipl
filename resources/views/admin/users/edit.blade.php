@extends('layouts.legal')

@section('content')
<div class="mx-auto max-w-lg">
    <div class="flex items-center justify-between">
        <div>
            <p class="rule-label text-xs font-black uppercase text-pipl-red">Panel administracyjny</p>
            <h1 class="mt-4 text-3xl font-black">Edytuj konto</h1>
        </div>
        <a href="{{ route('admin.users') }}" class="rounded border border-pipl-line bg-white px-4 py-2 text-sm font-bold text-pipl-graphite transition hover:bg-pipl-paper">
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

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-8 space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Imię i nazwisko</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">E-mail</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Nowe hasło <span class="text-pipl-steel font-normal">(pozostaw puste aby nie zmieniać)</span></label>
            <input type="password" name="password" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Powtórz nowe hasło</label>
            <input type="password" name="password_confirmation" class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100">
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Rola</label>
            <select name="role" required class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100">
                <option value="handlowiec" @selected(old('role', $user->role) === 'handlowiec')>Handlowiec</option>
                <option value="glowny_handlowiec" @selected(old('role', $user->role) === 'glowny_handlowiec')>Główny Handlowiec</option>
                <option value="admin" @selected(old('role', $user->role) === 'admin')>Administrator</option>
            </select>
        </div>
        <button type="submit" class="w-full rounded bg-pipl-red px-6 py-4 text-base font-black text-white transition hover:bg-pipl-redDark">
            Zapisz zmiany
        </button>
    </form>
</div>
@endsection
