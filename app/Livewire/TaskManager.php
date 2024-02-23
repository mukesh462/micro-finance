<?php

namespace App\Livewire;

use App\Models\Pen;
use Livewire\Component;
use Livewire\WithFileUploads;

class TaskManager extends Component
{
    use WithFileUploads;
    public $full_name, $phone_number, $image, $editId, $img_url;
    protected $debug = true;

    public function render()
    {
        $pens = Pen::all();
        return view('livewire.task-manager', compact('pens'));
    }

    // public function submitForm()
    // {
    //     $this->validate([
    //         'full_name' => 'required|min:3',
    //         'phone_number' => 'required|numeric',
    //         'image' => $this->editId ? 'nullable|image|max:1024' : 'required|image|max:1024',
    //     ]);

    //     $data = [
    //         'full_name' => $this->full_name,
    //         'phone_number' => $this->phone_number,
    //     ];

    //     // If in edit mode, update the existing record
    //     if ($this->editId) {
    //         dd('edit');
    //         $pen = Pen::findOrFail($this->editId);
    //         if ($this->image) {
    //             // Update image only if a new one is provided
    //             $data['image'] = $this->image->store('images', 'public');
    //         }
    //         $pen->update($data);
    //     } else {
    //         dd('succes');
    //         // Otherwise, create a new record
    //         $data['image'] = $this->image->store('images', 'public');
    //         Pen::create($data);
    //     }
    //     return redirect()->to(admin_url('pens'));

    //     session()->flash('message', 'Personal data submitted successfully.');

    //     // Clear the form fields after submission
    //     $this->reset(['full_name', 'phone_number', 'image', 'editId']);
    // }
    public function submitForm()
    {


        // Check if we are creating a new pen entry or updating an existing one
        if ($this->editId) {
            $validatedData = $this->validate([
                'full_name' => 'required',
                'phone_number' => 'required',
                'image' => 'nullable'
            ]);
            // Update existing pen entry
            $pen = Pen::findOrFail($this->editId);
            $pen->update($validatedData);

            // Update the image field if it's being changed
            if ($this->image) {
                // Handle the image upload and update the image field
                $pen->image = $this->image->store('images', 'public');
                $pen->save();
            }
        } else {
            $validatedData = $this->validate([
                'full_name' => 'required',
                'phone_number' => 'required',
                'image' => 'image|max:1024'
            ]);
            // Create a new pen entry
            if ($this->image) {
                $validatedData['image'] = $this->image->store('images', 'public');
            }

            Pen::create($validatedData);
        }


        // Redirect or perform any other action after the form submission
        return redirect()->to(admin_url('pens'));
    }




    public function mount()
    {
        // Retrieve existing data
        if ($this->editId) {
            $pen = Pen::findOrFail($this->editId);
            // dd($pen);
            // Pre-fill the form fields with existing data
            $this->full_name = $pen->full_name;
            $this->phone_number = $pen->phone_number;

            $this->img_url = $pen->image;
            // dd($this->full_name);
        }

        // You may or may not want to pre-fill the image field, depending on your use case
    }
}
