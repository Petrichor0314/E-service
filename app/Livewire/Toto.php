<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toto extends Component
{
    public $startTimes = [
        '08:30', '10:30', '14:30', '16:30'
    ];
    public $selectedStartTime;
    public $endTimes = [];

    public function updatedSelectedStartTime($value)
    {
        // Update the available end times based on the selected start time
        if ($value) {
            // Add your logic here to calculate the available end times
            // Example:
            if ($value === '08:30') {
                $this->endTimes = ['10:30', '12:30'];
            } elseif ($value === '10:30') {
                $this->endTimes = ['12:30'];
            } elseif ($value === '14:30') {
                $this->endTimes = ['16:30', '18:30'];
            } elseif ($value === '16:30') {
                $this->endTimes = ['18:30'];
            }
        } 
    }

    public function render()
    {
        return view('livewire.toto');
    }
}


