<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Show;

class MyBoxingShow extends Component
{
    public $boxingShows = [];
    public $isSeparatePage = true;
    public $userId;

    public function mount($userId = null, $separatable = true)
    {
        $this->isSeparatePage = $separatable;
        if (empty($userId)) {
            $this->userId = auth()->user()->id;
        } else {
            $this->userId = $userId;
        }
        $this->getBoxingShows();
    }

    private function getBoxingShows()
    {
        $this->boxingShows = Show::with(['createrDetail', 'countryDetail', 'stateDetail'])
            ->where('created_by', $this->userId)
            ->orderBy('date')
            ->get()->toArray();
    }

    public function cancelBoxingShow($id)
    {
        $boxingShow = Show::find($id);
        $boxingShow->delete();

        $this->notify('You canceled a boxing show.', 'success');
        $this->getBoxingShows();
    }

    public function render()
    {
        return view('livewire.my-boxing-show');
    }
}