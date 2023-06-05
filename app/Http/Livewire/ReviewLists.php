<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ReviewLists extends Component
{
    public $reviews = [];
    public $rating = 0;
    public $user;
    protected $listeners = ['create:review' => 'refreshReview'];
    public function refreshReview()
    {
        $this->filterReview();
    }

    public function mount($id = null)
    {
        $this->user = null;
        if (!empty($id)) {
            $this->user = User::find($id);
        }

        if (empty($this->user)) {
            $this->user = auth()->user();
        }
        $this->filterReview();
    }

    private function filterReview()
    {
        $this->reviews = [];
        $this->rating = 0;

        if (empty($this->user)) {
            return;
        }

        $this->reviews = $this->user->myReviews()->get()->toArray();
        if (count($this->reviews) > 0) {
            foreach ($this->reviews as $review) {
                $this->rating += $review['mark'];
            }

            $this->rating = $this->rating / count($this->reviews);
        }
    }
    public function render()
    {
        return view('livewire.review-lists');
    }
}