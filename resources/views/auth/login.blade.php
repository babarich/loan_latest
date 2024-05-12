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
                        <input id="email" class="form-control form-control-lg" type="email" name="email" value="{{old('email')}}" required
                               autofocus autocomplete="username" placeholder="email"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg" id="signin-password" name="password"
                                   placeholder="password"  required autocomplete="current-password" >
                            <button class="btn btn-secondary" type="button" onclick="createpassword('signin-password',this)" id="button-addon2">
                                <i class="ri-eye-off-line align-middle"></i></button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="col-xl-12 d-grid mt-4">
                        <button type="submit" class="btn btn-lg btn-primary">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



</x-guest-layout>
