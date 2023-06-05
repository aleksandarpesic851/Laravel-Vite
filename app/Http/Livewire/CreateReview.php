<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Review;

class CreateReview extends Component
{
    public $mark = 0;
    public $review = '';
    public $targetUserId = 0;

    protected function rules()
    {
        return [
            'mark' => ['required', 'numeric', 'gt:0'],
            'review' => ['required', 'string', 'min:10']
        ];
    }

    public function mount($id = null)
    {
        $this->targetUserId = $id;
    }

    public function createReview()
    {
        $this->validate();
        if (empty($this->targetUserId) || $this->targetUserId == auth()->user()->id) {
            // show alert
            $this->notify('Error in create Review', 'error');
            return;
        }

        Review::create([
            'from' => auth()->user()->id,
            'to' => $this->targetUserId,
            'review' => $this->review,
            'mark' => $this->mark
        ]);

        $this->emit('create:review');
        $this->notify('Posted a review', 'success');
    }

    public function render()
    {
        return view('livewire.create-review');
    }
}