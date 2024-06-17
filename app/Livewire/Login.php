<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|string|max:25')]
    public string $username = '';

    #[Validate('required|string|max:25')]
    public string $password = '';

    public function login()
    {
        $validated = $this->validate();

        try {

            if(auth()->attempt([
                'username' => $validated['username'],
                'password' => $validated['password'],
            ], true)){
                $this->redirectRoute('home', navigate: true);
            }else{
                $this->dispatch('swal',
                    icon: 'error',
                    title: 'Login gagal, username atau password salah',
                );
            }

        }catch (\Exception $e){
            $this->dispatch('swal',
                icon: 'error',
                title: $e->getMessage(),
            );
        }
    }


    #[Title('Login')]
    public function render()
    {
        return view('livewire.login');
    }
}
