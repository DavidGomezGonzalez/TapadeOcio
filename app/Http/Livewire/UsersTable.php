<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    protected $queryString = ['search' => ['except' => '']];

    public $search = "";
    public $perPage = 5;

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('email', 'LIKE', "%{$this->search}%")
                ->paginate($this->perPage)
        ]);
    }
}
