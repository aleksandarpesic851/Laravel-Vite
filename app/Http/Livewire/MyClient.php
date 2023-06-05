<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class MyClient extends Component
{
    public $boxer;
    public $managers;
    public $matchMakers;
    public $promoters;

    public function mount($userId = null)
    {
        if (empty($userId)) {
            $this->boxer = auth()->user();
        } else {
            $this->boxer = User::where('id', $this->ownerId)->first();
        }
        $this->getOwners();
    }

    private function getOwners()
    {
        $this->managers = [];
        $this->promoters = [];
        $this->matchMakers = [];

        $myBoxers = \App\Models\MyBoxer::where('boxer_id', $this->boxer->id)->get()->toArray();
        foreach ($myBoxers as $myBoxer) {
            $client = User::where('id', $myBoxer['owner_id'])
                ->with(['countryDetail', 'stateDetail', 'divisionDetail'])->first();
            $clientDetail = $client->toArray();
            $clientDetail['myBoxer'] = $myBoxer;

            if ($client->hasRole('Manager')) {
                array_push($this->managers, $clientDetail);
            } else if ($client->hasRole('Promoter')) {
                array_push($this->promoters, $clientDetail);
            } else if ($client->hasRole('MatchMaker')) {
                array_push($this->matchMakers, $clientDetail);
            }
        }
    }

    public function applyBoxer($id)
    {
        $myBoxer = \App\Models\MyBoxer::where('id', $id)->first();
        $myBoxer->update([
            'active' => true
        ]);
        $this->getOwners();
        // show alert
        $this->notify('Applied invitation', 'success');
    }

    public function render()
    {
        return view('livewire.my-client');
    }
}