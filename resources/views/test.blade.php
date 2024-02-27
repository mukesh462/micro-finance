@if ($type == 'create')
    @livewire('member-form')
@else
    @livewire('member-form', ['editId' => $id])
@endif
