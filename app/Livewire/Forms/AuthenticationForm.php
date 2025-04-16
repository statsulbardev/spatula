<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AuthenticationForm extends Form
{

    #[Validate('required', onUpdate: false, message:'Username harus terisi')]
    #[Validate('min:5', onUpdate: false, message:'Username minimal 5 karakter')]
    public string $username;

    #[Validate('required', onUpdate: false, message:'Password harus terisi')]
    #[Validate('min:5', onUpdate: false, message:'Password minimal 5 karakter')]
    public string $password;
}
