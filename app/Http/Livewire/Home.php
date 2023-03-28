<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }
    public function logOut(){
        auth()->logout();
        session()->flush();
        return redirect()->to('/login');
    }
}
