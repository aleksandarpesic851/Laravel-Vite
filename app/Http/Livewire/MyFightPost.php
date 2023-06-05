<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyFightPost extends Component
{
    public $fights = [];

    public function mount()
    {
        $this->getFights();
    }

    private function getFights()
    {
        $this->fights = \App\Models\Fight::orderBy('date')
            ->where('created_by', auth()->user()->id)
            ->whereDate('date', '>=', now())
            ->with(['countryDetail', 'stateDetail', 'divisionDetail', 'createrDetail'])
            ->get()->toArray();
    }

    public function showModal($id)
    {
        $this->emit('modal:fight-detail', $id);
    }

    public function cancelFight($id)
    {
        $fight = \App\Models\Fight::find($id);
        $fight->delete();

        $this->notify('You deleted a fight.', 'success');
        $this->getFights();
    }

    public function render()
    {
        return view('livewire.my-fight-post');
    }
}
