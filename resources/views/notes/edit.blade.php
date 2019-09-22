@extends ('layouts.app', ['title' => 'Notitie wijzigen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Personen</h1>
            <div class="page-subtitle">Notitie wijizigen voor {{ $note->person->name }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('person.notes.overview', $note->person) }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3">
                @include ('persons._partials._sidenav', ['person' => $note->person])
            </div>

            <div class="col-9">
                <form action="{{ route('person.notes.update', $note) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-file-edit-3 fe-brand mr-2"></i> Wijzigen van een notitie
                    </h6>

                    @csrf               {{-- Form field protection --}}
                    @method ('PATCH')   {{-- HTTP method binding --}}
                    @form($note)        {{-- Bind the datato the form --}}

                    <div class="form-row">
                        <div class="form-group col-8">
                            <label for="title">Titel <span class="text-danger">*</span></label>
                            <input type="text" id="title" class="form-control @error('titel', 'is-invalid')" placeholder="Titel van de notitie" @input('titel')>
                            @error('titel')
                        </div>

                        <div class="form-group col-12">
                            <label for="note">Notitie <span class="text-danger">*</span></label>
                            <textarea id=note" rows="6" class="form-control @error('notitie', 'is-invalid')" placeholder="Uw notitie" @input('notitie')>{{ $note->notitie ?? old('notitie') }}</textarea>
                            @error('notitie')
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button class="btn btn-success" type="submit">
                                <i class="fe fe-save mr-1"></i> Wijzigen
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
