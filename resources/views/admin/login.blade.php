@extends('layouts.legal')

@section('content')
<div class="mx-auto max-w-md">
    <p class="rule-label text-xs font-black uppercase text-pipl-red">Panel administracyjny</p>
    <h1 class="mt-4 text-3xl font-black">Logowanie</h1>

    @if ($errors->any())
        <div class="mt-6 border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            {{ $errors->first('password') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}" class="mt-8">
        @csrf
        <label class="mb-2 block text-sm font-bold text-pipl-graphite">Hasło</label>
        <input
            type="password"
            name="password"
            autofocus
            required
            class="w-full rounded border border-pipl-line bg-white p-4 text-base focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100"
        >
        <button type="submit" class="mt-6 w-full rounded bg-pipl-red px-6 py-4 text-base font-black text-white transition hover:bg-pipl-redDark">
            Zaloguj się
        </button>
    </form>
</div>
@endsection
