<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Feedback;

class FeedbackForm extends Component
{
    public $name = '';
    public $contact = '';
    public $message = '';
    public $isSuccess = false;

    protected $rules = [
        'message' => 'required|min:5|max:2000',
        'name' => 'nullable|max:255',
        'contact' => 'nullable|max:255',
    ];

    public function submit()
    {
        $this->validate();

        Feedback::create([
            'name' => $this->name,
            'contact' => $this->contact,
            'message' => $this->message,
        ]);

        $this->isSuccess = true;
        $this->reset(['name', 'contact', 'message']);
    }

    public function render()
    {
        return view('livewire.feedback-form');
    }
}
