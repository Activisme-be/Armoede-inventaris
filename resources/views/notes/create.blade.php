@extends ('layouts.app', ['title' => 'Notitie toevoegen'])

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Personen</h1>
            <div class="page-subtitle">Notitie toevoegen voor {{ $person->name }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('person.notes.overview', $person) }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include ('persons._partials._sidenav', ['person' => $person])
            </div>

            <div class="col-9">
                <form action="{{ route('person.notes.store', $person) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-edit-3 fe-brand mr-2"></i> Notitie toevoegen voor {{ $person->name }}
                    </h6>

                    @csrf {{-- HTTP form field protection --}}

                    <div class="form-row">
                        <div class="form-group col-7">
                            <label for="title">Titel <span class="text-danger">*</span></label>
                            <input type="text" id="title" class="form-control @error('title', 'is-invalid')" placeholder="Titel van de notitie" @input('titel')>
                            @error('titel')
                        </div>

                        <div class="form-group col-5">
                            <label for="visibility">Zichtbaarheid <span class="text-danger">*</span></label>

                            <select id="visibility" class="custom-select @error('is_public', 'is-invalid')" @input('is_public')>
                                @options($statuses, 'is_public', old('is_public'))
                            </select>

                            @error('visibility') {{-- Validation error view partial --}}
                        </div>

                        <div class="form-group col-12">
                            <label for="note">Notitie <span class="text-danger">*</span></label>
                            <textarea id=note" rows="6" class="form-control @error('notitie', 'is-invalid')" placeholder="Uw notitie" @input('notitie')>{{ $note->notitie ?? old('notitie') }}</textarea>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button class="btn btn-success" type="submit">
                                <i class="fe fe-save mr-1"></i> Opslaan
                            </button>

                            <button class="btn btn-light" type="reset">
                                <i class="fe fe-rotate-ccw text-danger"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
