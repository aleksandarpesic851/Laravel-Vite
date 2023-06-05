<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

// use Google\Cloud\Translate\V3\TranslationServiceClient;
// use Google\Cloud\Translate\V3\TranslateClient;
use Google\Cloud\Translate\TranslateClient;

class Chat extends Component
{
    public $outputLanguage;

    public $languages = [
        'en' => 'English',
        'es' => 'Spanish',
        'pt' => 'portuguese',
        // add more Languages here
    ];

    public $search;
    public $message;
    public $users;
    public $selectedUser;
    public $chatLists = [];

    public function mount()
    {
        $this->filterUsers();
    }

    private function filterUsers()
    {
        $myId = auth()->user()->id;
        if (empty($this->search)) {
            $this->users = User::where('id', "!=", $myId)->get();
        } else {
            $this->users = User::where('name', 'LIKE', "%" . $this->search . "%")
                ->where('id', '!=', $myId)->get();
        }
    }

    public function updatedSearch()
    {
        $this->filterUsers();
    }

    public function updatedSelectedUser()
    {
        $this->getChatLists();
    }

    private function getChatLists()
    {
        if (empty($this->selectedUser)) {
            $this->chatLists = [];
            return;
        }

        $myId = auth()->user()->id;
        $this->chatLists = \App\Models\Chat::with(['sender', 'receiver'])
            ->where(function ($query) use ($myId) {
                $query->where('sender_id', $this->selectedUser)
                    ->where('receiver_id', $myId);
            })
            ->orWhere(function ($query) use ($myId) {
                $query->where('sender_id', $myId)
                    ->where('receiver_id', $this->selectedUser);
            })
            ->orderBy('created_at')
            ->get();
    }

    public function sendMessage()
    {

        if (empty($this->selectedUser) || empty($this->message)) {
            return;
        }

        // to block email, phone number, URL
        $blocked_patterns = array(
            '/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', // email pattern
            '/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]/', // email pattern
            '/([0-9]{3})-([0-9]{3})-([0-9]{4})/', // Phone number pattern
            '/\d{10}/', // Phone number pattern
            '/\(\d{3}\) ?\d{3}-\d{4}/', // Phone number pattern
            '/((www\.|https|http|ftp?)[^\s]+)/', // URL pattern
        );

        $this->message = array($this->message);
        // Loop through the messages and check if they contain any blocked patterns
        foreach ($this->message as $msg) {
            foreach ($blocked_patterns as $pattern) {
                if (preg_match($pattern, $msg)) {
                    $this->notify('Blocked content detected in the message', 'danger');
                    $this->message = '';
                    return;
                }
            }
        }

        if(empty($this->outputLanguage) || $this->outputLanguage == null) {
            $this->outputLanguage = "en";
        }
        
        $translate = new TranslateClient([
            'keyFilePath' => storage_path('/keys/google-translate-key.json')
        ]);
        
        $result = $translate->translate($this->message, [
            'target' => $this->outputLanguage,
        ]);
        $this->message = $result['text'];

        \App\Models\Chat::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->selectedUser,
            'message' => $this->message
        ]);

        
        $this->message = '';
        $this->getChatLists();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}