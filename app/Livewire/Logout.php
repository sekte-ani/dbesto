<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Logout extends Component
{
    public function logoutModal()
    {
        $this->dispatch('swal-dialog',
            title: 'Anda ingin keluar?',
            showCancelButton: true,
            confirmButtonText: 'Keluar',
            functionName: 'logout'
        );
    }

    #[On('logout')]
    public function logout()
    {
        try {

            auth()->logout();

            $this->redirectRoute('login', navigate: true);

        }catch (\Exception $e){
            $this->dispatch('swal',
                icon: 'error',
                title: $e->getMessage(),
            );
        }
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
