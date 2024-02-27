<?php

// app/Http/Livewire/TextInput.php

namespace App\Livewire;

use Livewire\Component;

class TextInput extends Component
{
    public $label;
    public $name;
    public $value;
    public  $isRequired = false, $debug = true;



    public function render()
    {
        return view('livewire.text-input');
    }
}
