@extends ('layouts.app', ['title' => 'Notities'])

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Personen</h1>
            <div class="page-subtitle">Notities omtrent {{ ucfirst($person->name) }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('person.notes.create', $person) }}" class="btn btn-secondary shadow-sm mr-2">
                    <i class="fe fe-plus"></i>
                </a>
                <form method="GET" action="" class="border-0 shadow-sm form-search-xl">
                    <input type="text" class="form-search-xl border-0 form-control" @input('term') placeholder="Zoek notitie">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include ('persons._partials._sidenav', ['person' => $person])
            </div>

            <div class="col-9">
                <div class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-edit-3 fe-brand mr-2"></i> Notities omtrent {{ ucfirst($person->name) }}
                    </h6>

                    @include ('flash::message') {{-- Flash session view partial --}}

                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Auteur</th>
                                    <th class="border-top-0" scope="col">Titel</th>
                                    <th class="border-top-0" scope="col">Toegevoegd op</th>
                                    <th class="border-top-0" scope="col">&nbsp;</th> {{-- Column dedicated to the function shortcuts --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notes as $note) {{-- Loop trough the notes about the peron --}}
                                    <tr>
                                        <td class="font-weight-bold">{{ $note->creator->name }}</td>

                                        <td>{{ $note->titel }}</td>
                                        <td class="font-weight-light">{{ $note->created_at->format('d/m/Y') }}</td>

                                        <td> {{-- Function shortcuts --}}
                                            <span class="float-right">
                                                <a href="{{ route('person.notes.show', $note) }}" class="text-decoration-none text-muted">
                                                    <i class="fe fe-eye"></i> <span class="text-muted small ml-1">bekijk</span>
                                                </a>
                                            </span>
                                        </td> {{-- /// Function shortcuts --}}
                                    </tr>
                                @empty {{-- There are no notes from the person found --}}
                                    <tr>
                                        <td class="font-italic text-muted" colspan="4">
                                            <i class="fe fe-info mr-1"></i> Er zijn momenteel geen notities voor {{ $person->name }}
                                        </td>
                                    </tr>
                                @endforelse {{-- /// END loop --}}
                            </tbody>
                        </table>
                    </div>

                    {{ $notes->links() }} {{-- Pagination view partial --}}
                </div>
            </div>
        </div>
    </div>
@endsection
