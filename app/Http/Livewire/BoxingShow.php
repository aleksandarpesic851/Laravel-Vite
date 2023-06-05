<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Show;

class BoxingShow extends Component
{
    public $boxingShows = [];
    public $countries = [];
    public $states = [];
    public $slots = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];

    public $country = '0';
    public $state = '0';
    public $slot = '1';
    public $event_name = '';
    public $link = '';
    public $post_date = '';

    protected function rules()
    {
        return [
            'country' => ['required'],
            'state' => ['required'],
            'slot' => ['required'],
            'event_name' => ['required'],
            'link' => ['required'],
            'post_date' => ['required', 'after_or_equal:' . now()->format('Y-m-d')]
        ];
    }

    public function mount()
    {
        $this->countries = \App\Models\Country::orderBy('name')->get()->toArray();
        $this->getBoxingShows();
    }

    private function getBoxingShows()
    {
        $this->boxingShows = Show::with(['createrDetail', 'countryDetail', 'stateDetail'])
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->get()->toArray();
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

    public function createBoxingShow()
    {
        $this->validate();

        Show::create([
            'country' => $this->country,
            'state' => $this->state,
            'slots' => $this->slot,
            'event_name' => $this->event_name,
            'link' => $this->link,
            'date' => $this->post_date,
            'created_by' => auth()->user()->id
        ]);

        // show alert
        $this->notify('Created new boxing show.', 'success');

        $this->getBoxingShows();
    }

    public function render()
    {
        return view('livewire.boxing-show');
    }
}