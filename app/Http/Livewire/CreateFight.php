<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fight;

class CreateFight extends Component
{
    public $countries = [];
    public $states = [];
    public $divisions = [];
    public $rounds = ['4', '6', '8', '10'];

    public $country = '0';
    public $state = '0';
    public $division = '0';
    public $round = '4';
    public $passport = false;
    public $visa = false;
    public $post_date = '';
    public $oponent = '';
    public $notes = '';


    protected function rules()
    {
        return [
            'country' => ['required'],
            'state' => ['required'],
            'division' => ['required'],
            'round' => ['required'],
            'post_date' => ['required', 'after_or_equal:' . now()->format('Y-m-d')],
            'oponent' => ['required'],
            'notes' => ['required', 'string', 'min:10'],
        ];
    }

    public function mount()
    {
        $this->countries = \App\Models\Country::orderBy('name')->get()->toArray();
        $this->divisions = \App\Models\Division::get()->toArray();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedCountry($countryId)
    {
        if (!empty($countryId)) {
            $this->states = \App\Models\State::where('country_id', $countryId)->orderBy('name')->get()->toArray();
        } else {
            $this->states = [];
        }
        $this->state = null;
    }

    public function createFight()
    {
        $this->validate();

        $fight = Fight::create([
            'country' => $this->country,
            'state' => $this->state,
            'division' => $this->division,
            'round' => $this->round,
            'passport' => $this->passport,
            'visa' => $this->visa,
            'date' => $this->post_date,
            'oponent' => $this->oponent,
            'notes' => $this->notes,
            'created_by' => auth()->user()->id
        ]);

        $this->emit('create:fight');

        // show alert
        $this->notify('Created new fight.', 'success');
    }

    public function render()
    {
        if (auth()->user()->hasRole('MatchMaker'))
            return view('livewire.create-fight');
        return view('page-not-found');
    }
}
