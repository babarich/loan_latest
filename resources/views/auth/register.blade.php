<x-guest-layout>
    <div class="flex h-screen">
        <!-- Left Pane -->
        <div class="hidden lg:flex items-center justify-center flex-1  account-block" style="background-image: url('/images/woman.jpg')">
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
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>


                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Phone Number')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                      type="password"
                                      name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
                <div class="items-center text-center mt-8">
                    <div class="signinform text-center">
                        <a  href="{{route('login')}}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Already registered?
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-guest-layout>
