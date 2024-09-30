<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

            <!-- Exibe erros de validação -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulário de Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Campo de E-mail -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required autofocus>
                </div>

                <!-- Campo de Senha -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" name="password" id="password" class="mt-1 w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
                </div>

                <!-- Checkbox de "Lembrar-me" -->
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Lembrar-me</span>
                    </label>
                </div>

                <!-- Botão de Login -->
                <div class="mb-6">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                        Entrar
                    </button>
                </div>

                <!-- Link para recuperação de senha -->
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">
                            Esqueceu sua senha?
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
