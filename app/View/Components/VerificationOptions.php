<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class VerificationOptions extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $userId;
    public $placeholder;
    public $className;
    public $url;
    public function __construct($userId)
    {
        $this->userId = $userId;

        $user = User::findOrFail($userId);

        if ($user->verification_status == 1) {
            $this->placeholder = 'Bekukan Akun';
            $this->className = 'danger';
            $this->url = route('admin.banned_user', $userId);
        }
        if ($user->verification_status == 2) {
            $this->placeholder = 'Aktifkan Akun';
            $this->className = 'success';
            $this->url = route('admin.unbanned_user', $userId);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.verification-options');
    }
}
