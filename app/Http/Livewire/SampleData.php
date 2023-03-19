<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SampleData extends Component
{
    public function render()
    {
        return view('livewire.sample-data');
    }

    public function test()
    {
        $this->emit('sendNotif');
    }
}
