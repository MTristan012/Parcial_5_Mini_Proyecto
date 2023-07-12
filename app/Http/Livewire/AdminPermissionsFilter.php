<?php

namespace App\Http\Livewire;

use App\Models\User;

use Livewire\Component;


class AdminPermissionsFilter extends Component
{
    public $search = '';

    public function render()
    {
        $users = User::query()
            ->where('email', 'like', '%' . $this->search . '%')
            ->orWhere('permission', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.admin-permissions-filter', compact('users'));
    }
}