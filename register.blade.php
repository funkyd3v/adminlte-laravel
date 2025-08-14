<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register - {{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style>
            @keyframes fadeIn {
                0% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            @keyframes fadeInUp {
                0% {
                    opacity: 0;
                    transform: translateY(20px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fadeIn {
                animation: fadeIn 0.8s ease-out both;
            }

            .animate-fadeInUp {
                animation: fadeInUp 0.8s ease-out both;
            }

            .delay-100 {
                animation-delay: 0.1s;
            }

            .delay-200 {
                animation-delay: 0.2s;
            }
        </style>
    </head>

    <body
        class="flex min-h-screen items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 px-4">

        <div
            class="animate-fadeInUp w-full max-w-md transform space-y-6 rounded-2xl bg-white p-8 shadow-xl transition-all duration-500 ease-out">

            <!-- Logo / Title -->
            <div class="animate-fadeIn text-center">
                <a href="/" class="inline-block">
                    <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="Logo"
                        class="mx-auto h-20 w-20 rounded-full shadow-md">
                </a>
                <h2 class="mt-4 text-3xl font-bold text-gray-800">Create Account</h2>
                <p class="text-sm text-gray-500">Join us and get started today</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="animate-fadeIn mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800">
                    <div class="flex items-start">
                        <!-- Icon -->
                        <svg class="mr-3 mt-0.5 h-5 w-5 flex-shrink-0 text-red-500" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8
                      8-8 8 3.582 8 8zm-8 4a.75.75 0 01.75.75v.5a.75.75
                      0 01-1.5 0v-.5A.75.75 0 0110 14zm0-7a.75.75 0
                      00-.75.75v4.5a.75.75 0 001.5 0v-4.5A.75.75
                      0 0010 7z" clip-rule="evenodd" />
                        </svg>

                        <!-- Content -->
                        <div>
                            <ul class="list-inside space-y-1 font-semibold">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="animate-fadeIn space-y-4 delay-100">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="mt-1 block w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <!-- Button -->
                <div>
                    <button type="submit"
                        class="w-full transform rounded-lg bg-indigo-600 px-4 py-3 font-semibold text-white shadow-lg transition duration-300 hover:scale-[1.02] hover:bg-indigo-700">
                        Create Account
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            @if (Route::has('login'))
                <p class="animate-fadeIn text-center text-sm text-gray-600 delay-200">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:underline">
                        Sign in
                    </a>
                </p>
            @endif
        </div>
    </body>

</html>
