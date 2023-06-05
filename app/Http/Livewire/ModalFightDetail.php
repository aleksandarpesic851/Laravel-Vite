<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fight;
use Illuminate\Support\Facades\Auth;

class ModalFightDetail extends Component
{
    public $fight;
    public $show = false;
    public $boxrec_id;
    protected $listeners = ['modal:fight-detail' => 'showModal'];

    public function showModal($id)
    {
        $this->fight = Fight::find($id);
        $this->show = true;
    }

    public function applyFight()
    {
        if (!empty($this->boxrec_id) && empty(auth()->user()->boxrec_id)) {
            auth()->user()->update(['boxrec_id' => $this->boxrec_id]);
        }

        $this->fight->update(['applied_by' => auth()->user()->id]);
        $this->notify('You applied to this fight.', 'success');
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.modal-fight-detail');
    }
}
