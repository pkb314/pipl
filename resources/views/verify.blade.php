<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weryfikacja Email - PIPL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { colors: { pipl: { graphite: '#3F474F', red: '#D71920' } } }
            }
        }
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-xl shadow-2xl max-w-md w-full text-center">
    <div class="bg-pipl-graphite w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
    </div>

    <h2 class="text-2xl font-bold text-pipl-graphite mb-2">Sprawdź skrzynkę odbiorczą</h2>
    <p class="text-gray-600 mb-6">
        Wysłaliśmy 6-cyfrowy kod na adres: <br>
        <strong>{{ $email }}</strong>
    </p>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('otp.verify.submit') }}" method="POST">
        @csrf
        <div class="mb-6">
            <input type="text" name="otp" maxlength="6"
                   class="w-full text-center text-3xl tracking-widest p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-pipl-red font-bold"
                   placeholder="000000" autofocus required>
        </div>

        <button type="submit" class="w-full bg-pipl-red hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
            Potwierdź i dołącz
        </button>
    </form>

    <a href="/" class="block mt-6 text-sm text-gray-400 hover:text-gray-600">
        &larr; Wróć do formularza (Popraw email)
    </a>
</div>

</body>
</html>
