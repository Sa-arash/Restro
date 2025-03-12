<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $phone_number = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->phone_number = Auth::user()->phone_number;
        // $this->name = Auth::user()->name;
        // $this->name = Auth::user()->name;
        // $this->name = Auth::user()->name;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user->fill($validated);

        // if ($user->isDirty('email')) {
        //     $user->email_verified_at = null;
        // }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/home', navigate: true);
    }
}; ?>

<section>
    {{-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
        {{asset('front/css/iconBootstrap.css')}}
    </header> --}}

    <main class="container mt-5 mb-5 container-main">
        <section class="right-profile">
            <div class="box-right-profile">
                <div class="top-profile-box">
                    <img src="{{ asset('front/image/Ellipse 18.png') }}" alt="Ellipse" class="Ellipse" />
                    <div>
                        <p>{{ $name }}</p>
                        <p>{{ $phone_number }}</p>
                    </div>
                </div>
                <div class="bottom-profile-box">
                    <ul>
                        <li class="list-profile">
                            <img src="{{ asset('front/image/user.png') }}" alt="" />
                            <p class="user-profile align-style">پروفایل</p>
                        </li>
                        <li class="list-profile" wire:click="logout" style="cursor: pointer">
                            <img src="{{ asset('front/image/logout.png') }}" alt="" />
                            <p class="exit align-style">خروج</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="left-profile">
            <h2 class="title">پروفایل من</h2>
            <div class="box-form">
                <form wire:submit="updateProfileInformation">
                    <div class="wrapper-input">

                        <div class="mb-3 col-12 col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">نام و نام خانوادگی</label>

                            <x-text-input wire:model="name" id="name" name="name" type="text"
                                placeholder="نام خانوادگی خود را وارد کنید" class="form-control input-form input"
                                required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">شماره موبایل</label>

                            <x-text-input disabled wire:model="phone_number" id="phone_number" name="phone_number" type="text"
                                placeholder="شماره تلفن خود را وارد کنید" class="form-control input-form input" required
                                autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>
                    </div>

                    <button type="submit" class="send-data">ثبت اطلاعات</button>

                    <x-action-message class="me-3" on="profile-updated">
                       با موفقیت ثبت شد 
                    </x-action-message>
                </form>
            </div>
        </section>
    </main>

    {{-- <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form> --}}

</section>
