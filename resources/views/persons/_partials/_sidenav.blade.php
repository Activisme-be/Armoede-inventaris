<div class="list-group list-group-transparent">
    <a href="{{ route('persons.show', $person) }}" class="list-group-item {{ active('persons.show') }} list-group-item-action">
        <i class="fe fe-info fe-brand mr-2"></i> Algemene informatie
    </a>

    <a href="{{ route('persons.delete', $person) }}" class="list-group-item {{ active('persons.delete') }} list-group-item-action">
        <i class="fe fe-trash-2 fe-brand mr-2"></i> Verwijder persoon
    </a>
</div>
