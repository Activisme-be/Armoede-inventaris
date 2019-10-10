<div class="list-group list-group-transparent">
    <a href="{{ route('inventory.item', $item) }}" class="{{ active('inventory.item') }} list-group-item list-group-item-action">
        <i class="fe fe-brand fe-info mr-2"></i> Algemene informatie
    </a>

    @if ($currentUser->hasAnyRole('admin', 'webmaster'))
        <a href="{{ route('inventory.item.add', $item) }}" class="{{ active('inventory.item.add') }} list-group-item list-group-item-action">
            <i class="fe fe-brand fe-plus mr-2"></i> Items inboeken
        </a>
    @endif

    @can ('delete', $item) {{-- Check if the user is permitted to perform the operation --}}
        <a href="{{ route('inventory.item.delete', $item) }}" class="{{ active('inventory.item.delete') }} list-group-item list-group-item-action">
            <i class="fe fe-brand fe-trash-2 mr-2"></i> Verwijder item
        </a>
    @endcan
</div>
