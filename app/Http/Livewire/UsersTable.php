<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    protected $queryString = ['search' => ['except' => '']];

    public $search    = "";
    public $perPage   = 5;
    public $component = 'users-table';

    public $modalOpen = false;

    public function openModal()
    {
        $this->modalOpen = true;
    }
    public function closeModal()
    {
        $this->modalOpen = false;
    }
    public function confirmAction()
    {
        // Perform your action here
        // ...
        $this->modalOpen = false;
    }

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('email', 'LIKE', "%{$this->search}%")
                ->paginate($this->perPage),
            'modalOpen' => $this->modalOpen
        ]);
    }
}
