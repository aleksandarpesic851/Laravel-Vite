<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchFight extends Component
{
    public $countries = [];
    public $states = [];
    public $divisions = [];
    public $rounds = ['All', '4', '6', '8', '10'];
    public $fights = [];

    public $country = '0';
    public $state = '0';
    public $division = '0';
    public $round = 'All';
    public $passport = 0;
    public $visa = 0;
    // protected $listeners = ['create:fight' => '$refresh'];
    protected $listeners = ['create:fight' => 'refreshSearchFight'];

    public function refreshSearchFight()
    {
        $this->filterFights();
    }

    public function mount()
    {
        $this->countries = \App\Models\Country::orderBy('name')->get()->toArray();
        array_unshift($this->countries, ['id' => 0, 'name' => 'All']);

        $this->divisions = \App\Models\Division::get()->toArray();
        array_unshift($this->divisions, ['id' => 0, 'name' => 'All']);

        $this->filterFights();
    }

    public function updated()
    {
        $this->filterFights();
    }

    public function updatedCountry($countryId)
    {
        if (!empty($countryId)) {
            $this->states = \App\Models\State::where('country_id', $countryId)->orderBy('name')->get()->toArray();
            array_unshift($this->states, ['id' => 0, 'name' => 'All']);
        } else {
            $this->states = [];
        }
        $this->state = null;
    }

    private function filterFights()
    {
        $fightEloquent = \App\Models\Fight::orderBy('date');
        if (!empty($this->country)) {
            $fightEloquent = $fightEloquent->where('country', $this->country);
        }
        if (!empty($this->state)) {
            $fightEloquent = $fightEloquent->where('state', $this->state);
        }
        if (!empty($this->division)) {
            $fightEloquent = $fightEloquent->where('division', $this->division);
        }
        if (!empty($this->round) && $this->round != 'All') {
            $fightEloquent = $fightEloquent->where('round', $this->round);
        }
        $fightEloquent = $fightEloquent->where('passport', $this->passport);
        $fightEloquent = $fightEloquent->where('visa', $this->visa);
        $fightEloquent = $fightEloquent->whereDate('date', '>=', now());

        $this->fights = $fightEloquent
            ->with(['countryDetail', 'stateDetail', 'divisionDetail', 'createrDetail'])
            ->get()->toArray();
    }

    public function showModal($id)
    {
        $this->emit('modal:fight-detail', $id);
    }

    public function render()
    {
        return view('livewire.search-fight');
    }
}
