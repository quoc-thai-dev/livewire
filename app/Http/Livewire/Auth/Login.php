<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $hide = true, $user, $email = "quocthai0099@gmail.com", $password = "quocthai123";
    protected $listeners=["test123"];
    public function test123(){
        dd(1);
    }
    public function mount()
    {
        if (auth()->check()) {
            $this->redirect('home');
        }
    }

    protected $rules = [
        'email' => 'required|email', //|unique:users,email
        'password' => 'required|min:6'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    protected $messages = [
        'email.required' => 'Vui lòng nhập email!',
        'email.email' => 'Địa chỉ email không đúng định dạng!',
        'password.required' => "Vui lòng nhập mật khẩu!",
        'password.min' => "Mật khẩu phải có ít nhất 6 ký tự!",
//        'email.unique'=>"Địa chỉ email này đã tồn tại!"
    ];

    public function validateLogin()
    {
        $validated = $this->validate($this->rules);
        if (\Auth::attempt($validated)) {
            session()->flash('message-success', "Đăng nhập thành công!");
            return redirect()->intended('home');
        } else {
            $this->emit('focusPassword');
            $this->dispatchBrowserEvent('hide-toast', ['timeout' => 5000]);
            session()->flash('message-error', "Xác thực người dùng thất bại!");
        }
    }

    public function hideToast()
    {
        $this->hide = false;
        $this->render();
    }
}
