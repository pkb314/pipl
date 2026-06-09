@extends('layouts.legal', ['title' => 'Weryfikacja adresu e-mail - PIPL'])

@section('content')
    <section class="mx-auto max-w-xl border border-pipl-line bg-white p-8 md:p-10">
        <p class="rule-label text-xs font-black uppercase text-pipl-red">Weryfikacja kontaktu</p>
        <h1 class="mt-3 text-3xl font-black">Sprawdź skrzynkę odbiorczą.</h1>
        <p class="mt-4 leading-7 text-pipl-graphite">
            Wysłaliśmy kod weryfikacyjny na adres:
            <strong class="text-pipl-ink">{{ $email }}</strong>
        </p>

        @if ($errors->any())
            <div class="mt-6 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('otp.verify.submit') }}" method="POST" class="mt-8">
            @csrf
            <label class="mb-2 block text-sm font-bold text-pipl-graphite">Kod weryfikacyjny</label>
            <input type="text" name="otp" maxlength="6"
                   class="w-full rounded border border-pipl-line bg-pipl-porcelain p-4 text-center text-2xl font-black tracking-[0.3em] focus:border-pipl-red focus:outline-none focus:ring-4 focus:ring-red-100"
                   placeholder="000000" autofocus required>

            <button type="submit" class="mt-5 w-full rounded bg-pipl-red px-6 py-4 font-black text-white transition hover:bg-pipl-redDark">
                Potwierdź adres e-mail
            </button>
        </form>

        <a href="/" class="mt-6 block text-sm font-semibold text-pipl-steel hover:text-pipl-red">
            Wróć do formularza
        </a>
    </section>
@endsection
