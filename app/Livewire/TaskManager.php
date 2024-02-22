<?php

namespace App\Livewire;

use App\Models\Pen;
use Livewire\Component;
use Livewire\WithFileUploads;

class TaskManager extends Component
{
    use WithFileUploads;
    public $full_name, $phone_number, $image ,$editId, $mode;
    protected $debug = true;
    
    public function render()
    {
        $pens = Pen::all();
        return view('livewire.task-manager',compact('pens'));
    }

    public function submitForm()
    {
        $this->validate([
            'full_name' => 'required|min:3',
            'phone_number' => 'required|numeric',
            'image' => $this->editId ? 'nullable|image|max:1024' : 'required|image|max:1024',
        ]);

        $data = [
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
        ];

        // If in edit mode, update the existing record
        if ($this->editId) {
            $pen = Pen::findOrFail($this->editId);
            if ($this->image) {
                // Update image only if a new one is provided
                $data['image'] = $this->image->store('images', 'public');
            }
            $pen->update($data);
            

        } else {
            // Otherwise, create a new record
            $data['image'] = $this->image->store('images', 'public');
            Pen::create($data);
        }

        session()->flash('message', 'Personal data submitted successfully.');

        // Clear the form fields after submission
        $this->reset(['full_name', 'phone_number', 'image', 'editId']);
    }

    public function edit($id)
    {
        $this->editId = $id;
        $pen = Pen::findOrFail($id);
        $this->full_name = $pen->full_name;
        $this->phone_number = $pen->phone_number;
        // Note: The image field won't be pre-filled for security reasons.
        // You can choose to add the logic to pre-fill it if needed.
        // $this->image = $pen->image;

        // Emit the event to open the form modal
        $this->emit('openFormModal', route('pens.edit', ['id' => $id]));
    }

    public function delete($id)
    {
        Pen::findOrFail($id)->delete();

        session()->flash('message', 'Personal data deleted successfully.');
    }

    public function mount($mode, $editId = null)
    {
        $this->mode = $mode;
        $this->editId = $editId;
    }


}