<x-guest-layout>
    <!-- Session Status -->
    <div class="flex h-screen">
        <!-- Left Pane -->
        <div class="hidden lg:flex items-center justify-center flex-1  account-block"
             style="background-image: url('{{asset("assets/images/woman.jpg")}}');
background-repeat: no-repeat;  background-size: cover;">
            <div class="max-w-md text-center">
                <div class="hero-in">
                    <div class="text-4xl text-white leading-10 py-1 font-[900]">MINAJO<br> Finance Limited</div>
                    <div class="text-md mt-2 text-white leading-4">We are the best in making your financial life easy.</div>
                </div>
            </div>
        </div>
        <!-- Right Pane -->
        <div class="w-full bg-gray-100 lg:w-1/2 flex items-center justify-center">
            <div class="max-w-md w-full p-6">
                <h1 class="text-4xl font-[900] leading-5 mb-6 text-black text-center">MINAJO FINANCE LTD </h1>
                <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">Make your financial life easy </h1>
                <div  class="mb-4 font-medium text-sm text-green-600">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ms-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
                <div class="items-center text-center mt-8">
                    <div class="signinform text-center">
                        <h4>Don’t have an account? <a href="{{route('register')}}" class="hover-a text-blue-800">Sign Up</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-guest-layout>
