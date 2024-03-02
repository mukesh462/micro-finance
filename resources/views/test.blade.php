@if ($type == 'create')
    @include('member-form')
@else
    @livewire('member-form', ['editId' => $id])
@endif
