@extends('layouts.legal', ['title' => 'Status płatności - PIPL'])

@section('content')
    <section class="border border-pipl-line bg-white p-8 text-center md:p-12">
        <p class="rule-label text-xs font-black uppercase text-pipl-red">Płatność Przelewy24</p>
        <h1 class="mx-auto mt-3 max-w-3xl text-3xl font-black md:text-5xl">Transakcja została przekazana do weryfikacji.</h1>
        <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-pipl-graphite">
            Po zakończeniu płatności operator Przelewy24 przesyła do systemu Izby automatyczne potwierdzenie statusu transakcji.
        </p>
        @if($sessionId)
            <p class="mx-auto mt-6 max-w-xl border border-pipl-line bg-pipl-paper p-4 text-sm font-semibold text-pipl-graphite">
                Identyfikator sesji: {{ $sessionId }}
            </p>
        @endif
        <a href="{{ url('/') }}" class="mt-8 inline-flex rounded bg-pipl-red px-6 py-3 font-black text-white transition hover:bg-pipl-redDark">
            Wróć na stronę główną
        </a>
    </section>
@endsection
