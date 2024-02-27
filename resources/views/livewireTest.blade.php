@if ($type == 'create')
    @livewire('task-manager')
@else
    @livewire('task-manager', ['editId' => $id])
@endif
