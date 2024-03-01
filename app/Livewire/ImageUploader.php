<?php

// app/Http/Livewire/ImageUploader.php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUploader extends Component
{
    public $image;
    public $imageName; // Dynamic image name property
    use WithFileUploads;

    protected $listeners = ['resetImage'];

    public function mount($imageName = null)
    {
        $this->imageName = $imageName;
    }

    public function render()
    {
        return view('livewire.image-uploader');
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024', // max 1MB
        ]);
    }

    public function resetImage()
    {
        $this->reset('image');
    }
}
