<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class MyBoxer extends Component
{
    public $myBoxers = [];
    public $allBoxers = [];
    public $boxer_id = null;
    public $canEdit = true;
    public $isSeparatePage = true;
    public $ownerId = null;

    protected function rules()
    {
        return [
            'boxer_id' => ['required']
        ];
    }

    public function mount($userId = null, $editable = true, $separatable = true)
    {
        $this->canEdit = $editable;
        $this->isSeparatePage = $separatable;
        if (empty($userId)) {
            $this->ownerId = auth()->user()->id;
        } else {
            $this->ownerId = $userId;
        }
        $this->getBoxers();
    }

    private function getBoxers()
    {
        $owner = User::where('id', $this->ownerId)->first();
        $this->myBoxers = $owner->myBoxers->toArray();
        $boxerIds = [];
        foreach ($this->myBoxers as $idx => $boxer) {
            $boxerIds[$idx] = $boxer['boxer_id'];
            $user = User::where('id', $boxer['boxer_id'])
                ->with(['countryDetail', 'stateDetail', 'divisionDetail'])
                ->get()->toArray();
            $this->myBoxers[$idx]['boxer'] = $user[0];
        }

        $this->allBoxers = User::role('Boxer')
            ->whereNotIn('id', $boxerIds)
            ->get()->toArray();
    }

    public function cancelBoxer($id)
    {
        $myboxer = \App\Models\MyBoxer::find($id);
        $myboxer->delete();

        $this->notify('You canceled a boxer.', 'success');
        $this->getBoxers();
    }

    public function applyBoxer()
    {
        $this->validate();

        \App\Models\MyBoxer::create([
            'boxer_id' => $this->boxer_id,
            'owner_id' => $this->ownerId
        ]);
        $this->boxer_id = null;
        $this->getBoxers();
        // show alert
        $this->notify('Added new boxer', 'success');
    }

    public function render()
    {
        return view('livewire.my-boxer');
    }
}