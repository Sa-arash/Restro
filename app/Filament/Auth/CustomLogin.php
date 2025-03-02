<?php

namespace App\Filament\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login;
use Illuminate\Validation\ValidationException;

class CustomLogin extends Login
{
   
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getPhoneFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone_number')
            ->label('نام کاربری')
            ->required()
            ->numeric()
            ->autocomplete(false)
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'phone_number' => $data['phone_number'],
            'password' => $data['password'],
        ];
    }
    
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.phone_number' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
