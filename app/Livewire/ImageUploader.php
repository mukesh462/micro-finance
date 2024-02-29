<?php

// app/Http/Livewire/ImageUploader.php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUploader extends Component
{
    use WithFileUploads;

    public $image, $img, $pre;
    protected $listeners = ['showPreview'];


    public function render()
    {
        return view('livewire.image-uploader');
    }

    public function showPreview()
    {
        // dd();
        // $this->dispatch('showPreview', $this->image->temporaryUrl());
        // $this->$pre =$this->image->temporaryUrl();
        // $this->emit('showPreview', $this->image->temporaryUrl());
    }
}
