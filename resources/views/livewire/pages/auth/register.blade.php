<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Session;

new #[Layout('layouts.guest')] class extends Component
 {
    public string $name = '';
    public $phone_number;
    public $verifyCode;
    public string $password = '';
    public string $password_confirmation = '';

    public $rules = [
        'name' => ['required', 'string', 'max:255'],
        'phone_number' => ['required', 'string', 'numeric', 'max_digits:11', 'min_digits:10', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'verifyCode' => ['required', 'numeric'],
    ];
    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        //   session()->flush();

        // dd(Session::get('code'),$this->verifyCode);
        $this->validate();

        if (Session::get('tryCount') >= 3) {
            $this->addError('verifyCode', 'تعداد تلاش بیش از حد');
        } else {
            if ($this->verifyCode == Session::get('code') && Session::get('phone_number') != null) {
                $this->create();
            } else {
                Session::put('tryCount', Session::get('tryCount') + 1);
                $this->addError('verifyCode', 'کد تایید اشتباه است');
            }
        }
    }

    public function create()
    {
        $user = User::create([
            'name' => $this->name,
            'phone_number' => Session::get('phone_number'),
            'number_verified_at' => now(),
            'password' => $this->password,
        ]);
        Auth::login($user);
        Session::put('issend', false);
        Session::flash('phone_number');
        Session::flash('tryCount');
        Session::flash('code');
        return redirect()->route('home');
    }

    public function sendCode()
    {
        $this->validateOnly('phone_number');

        Session::put('issend', true);
        Session::put('phone_number', $this->phone_number);
        Session::put('tryCount', 0);
        Session::put('code', rand(1000, 9999));

        // Sms::pattern('verifyCode')->data([
        //     'token'=>Session::get('code')
        // ])->to([Session::get('number')])->send();
    }

    public function render(): mixed
    {
        Session::get('phone_number') ? ($this->phone_number = Session::get('phone_number')) : '';
        return view('livewire.pages.auth.register');
    }
};
?>

<div class="login-container">
    <form class="login-form" wire:submit="register">
        <h2 style="text-align: center">ثبت نام کاربر</h2>
        <div class="input-group">
            <label for="family"> نام و نام خانوادگی<span class="text-red-500">*</span></label>
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="input-group">
            <label for="phone_number">شماره موبایل <span class="text-red-500">*</span></label>

            <div class="flex items-center space-x-2">
                <input wire:model="phone_number" id="phone_number" class="block mt-1 w-full h-10" type="text"
                    name="phone_number" required autocomplete="phone_number"
                    @if (Session::get('phone_number')) disabled @endif />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                @if (!Session::get('issend'))
                    <button class="h-10 px-0 text-xs btn-vorod  rounded   whitespace-nowrap" wire:click="sendCode"
                        wire:ignore>
                        دریافت کد
                    </button>
                @else
                    <span class="text-sm">کد: {{ Session::get('code') }}</span>
                    <button title="3 دقیقه بعد"
                        class="h-10 px-3 text-xs bg-gray-500 text-white rounded hover:bg-gray-600 transition whitespace-nowrap">
                        ارسال مجدد
                    </button>
                @endif
            </div>




        </div>



        <div class="input-group">
            <label for="verifyCode">کد تایید <span class="text-red-500">*</span></label>

            <x-text-input wire:model="verifyCode" id="verifyCode" class="block mt-1 w-full" type="text"
                name="verifyCode" />
            <x-input-error :messages="$errors->get('verifyCode')" class="mt-2" />

        </div>
        <div class="input-group">
            <label for="password"> رمز عبور<span class="text-red-500">*</span></label>
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="input-group">
            <label for="repassword"> تکرار رمز عبور<span class="text-red-500">*</span></label>
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="input-group remember-me">
            <input type="checkbox" id="remember" name="remember" />
            <label for="remember">مرا به خاطر بسپار</label>
        </div>
        <x-primary-button class="btn-vorod button text-center">
            <span class="text-center mx-auto">ورود</span>
        </x-primary-button>


        <a href="{{ route('login') }}" wire:navigate>حساب کاربری دارید ؟‌وارد شوید</a>
    </form>
</div>
