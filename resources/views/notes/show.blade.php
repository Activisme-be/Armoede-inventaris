@extends ('layouts.app', ['title' => 'Notities'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Notities</h1>
            <div class="page-subtitle">Notitie weergave van <span class="font-weight-bold"n>{{ $note->person->name }}</span></div>

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

            <div class="col-md-9">
                <div class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-file-text fe-brand mr-2"></i> {{ ucfirst($note->titel) }}
                    </h6>

                    {!! str_replace('<p>', '<p class="card-text">', md_to_html($note->notitie)) !!}
                    <hr class="mt-0">

                    <p class="card-text">
                        <a href="{{ route('person.notes.overview', $note->person) }}" class="card-link text-muted">
                            <i class="fe fe-chevrons-left mr-1"></i> Overzicht
                        </a>

                        <span class="float-right">
                            <a href="" class="card-link text-muted">
                                <i class="fe fe-edit mr-1"></i> Wijzig
                            </a>

                            <a href="{{ route('person.notes.delete', $note) }}" class="card-link text-danger">
                                <i class="fe fe-trash-2 mr-1"></i> Verwijder
                            </a>
                        </span>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
