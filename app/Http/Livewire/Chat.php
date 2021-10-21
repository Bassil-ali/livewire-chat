<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Message;

class Chat extends Component
{
    public $messageText;

    public function render()
    {
        $messages = Message::with('user')->latest()->take(10)->get()->sortBy('id');

        return view('livewire.chat', compact('messages'));
    }

    public function sendMessage()
    {
        $messageText = $this->validate([
            'messageText' => 'required',
        ]);

        Message::create([
            'user_id' => auth()->user()->id,
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
    }

}
