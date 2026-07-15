<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kesalahan Server - 500</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen dark:bg-gray-800 dark:text-white">
    <div class="max-w-md w-full space-y-8 text-center px-4">
        <div>
            <h1 class="text-9xl font-extrabold text-red-600 dark:text-red-500">500</h1>
            <h2 class="mt-6 text-3xl font-bold">Kesalahan Internal Server</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Maaf, terjadi kesalahan pada sistem kami. Tim kami telah diberitahu dan sedang memperbaikinya.
            </p>
        </div>
        <div class="mt-8">
            <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <svg class="mr-2 -ml-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
