<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(route('home'));
    }
}; ?>
{{--
<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- phone_number Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div> --}}




<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="login-container">
    <form class="login-form" wire:submit="login">
        <h2 class="title">ورود به حساب کاربری</h2>
        <div class="input-group">

            <label for="phone_number">نام کاربری</label>
            <x-text-input wire:model="form.phone_number" id="phone_number" class="block mt-1 w-full" type="text"
                name="phone_number" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.phone_number')" class="mt-2" />
        </div>

        <div class="input-group">
            <label for="password">رمز عبور</label>
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>
        <div class="input-group remember-me">

            <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <label for="remember">مرا به خاطر بسپار</label>
        </div>
{{--        <div class="input-group">--}}
{{--            <a href="{{ route('password.request') }}" wire:navigate class="forgot-password">فراموشی رمز عبور</a>--}}
{{--        </div>--}}
        <x-primary-button  class="btn-vorod button text-center">
            <span class="text-center mx-auto">ورود</span>
        </x-primary-button>
        <a href="{{ route('register') }}" >ایجاد حساب کاربری</a>
    </form>
</div>







{{--

{{-- <div>
    <!-- Session Status -->


    <form >
        <!-- phone_number Address -->
        <div>
            <x-input-label for="phone_number" :value="__('phone_number')" />
            <x-text-input wire:model="form.phone_number" id="phone_number" class="block mt-1 w-full" type="number" name="phone_number" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.phone_number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href=">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>










</div> --}}
{{--

<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="login-container">
    <form class="login-form" wire:submit="login">
        <h2 class="title">ورود به حساب کاربری</h2>
        <div class="input-group">

            <label for="phone_number">نام کاربری</label>
            <x-text-input wire:model="form.phone_number" id="phone_number" class="block mt-1 w-full" type="number"
                name="phone_number" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.phone_number')" class="mt-2" />
        </div>
        <div class="input-group">
            <label for="password">رمز عبور</label>
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>
        <div class="input-group remember-me">

            <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
            <label for="remember">مرا به خاطر بسپار</label>
        </div>
        <div class="input-group">
            <a href="{{ route('password.request') }}" wire:navigate class="forgot-password">فراموشی رمز عبور</a>
        </div>
        <button type="submit" class="btn-vorod">ورود</button>
        <a href="{{ route('register') }}">ایجاد حساب کاربری</a>
    </form>
</div> --}}
