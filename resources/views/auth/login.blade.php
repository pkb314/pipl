@extends('layouts.legal')

@section('content')
<div class="mx-auto max-w-md">
    <p class="rule-label text-xs font-black uppercase text-pipl-red">Logowanie</p>
    <h1 class="mt-4 text-3xl font-black">Panel administracyjny</h1>

    @if ($errors->any())
        <div class="mt-6 border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-4">
        @csrf
        <div>
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">E-mail</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                autofocus
                required
                class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100"
                placeholder="admin@pipl.pl"
            >
        </div>
        <div>
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Hasło</label>
            <input
                type="password"
                name="password"
                required
                class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100"
            >
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember" class="rounded border-pipl-line text-pipl-red focus:ring-pipl-red">
            <label for="remember" class="text-sm text-pipl-graphite">Zapamiętaj mnie</label>
        </div>
        <button type="submit" class="w-full rounded bg-pipl-red px-6 py-4 text-base font-black text-white transition hover:bg-pipl-redDark">
            Zaloguj się
        </button>
    </form>
</div>
@endsection
