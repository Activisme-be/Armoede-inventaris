<div class="list-group list-group-transparent">
    <a href="{{ route('persons.show', $person) }}" class="list-group-item {{ active('persons.show') }} list-group-item-action">
        <i class="fe fe-info fe-brand mr-2"></i> Algemene informatie
    </a>

    <a href="{{ route('person.notes.overview', $person) }}"
       class="{{ active('person.notes.*') }} list-group-item list-group-item-action d-flex justify-content-between align-items-center">

        <span class="float-left">
            <i class="fe fe-edit-3 fe-brand mr-2"></i> Notities
        </span>

        <span class="badge badge-counter badge-pill">
            {{ $person->getOverviewNotes()->count() }}
        </span>
    </a>

    <a href="{{ route('persons.delete', $person) }}" class="list-group-item {{ active('persons.delete') }} list-group-item-action">
        <i class="fe fe-trash-2 fe-brand mr-2"></i> Verwijder persoon
    </a>
</div>
