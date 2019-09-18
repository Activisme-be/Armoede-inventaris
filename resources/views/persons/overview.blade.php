@extends ('layouts.app', ['title' => 'Personen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Personen</h1>
            <div class="page-subtitle">Overzicht van hulpbehoevende personen</div>

            <div class="d-flex page-options">
                <a href="{{ route('persons.create') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search-xl ml-2">
                    <input type="text" class="form-search-xl border-0 form-control" @input('term') placeholder="Zoeken op naam of email">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card border-0 shadow-sm card-body">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-users fe-brand mr-2"></i> Overzicht van hulpbehoevende personen
            </h6>

            @include ('flash::message') {{-- Flash session view partial --}}

            <div class="table-responsive">
                <table class="table table-sm mb-0 table-hover">
                    <thead>
                        <tr>
                            <th class="border-top-0 text-muted" scope="col">#</th>
                            <th class="border-top-0" scope="col">Naam</th>
                            <th class="border-top-0" scope="col">Email adres</th>
                            <th class="border-top-0" scope="col">Open aanvragen</th>
                            <th class="border-top-0" scope="col">Registratie datum</th>
                            <th class="border-top-0" scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($persons as $person)
                            <tr>
                                <td class="font-weight-bold text-muted">#{{ $person->id }}</td>
                                <td>{{ $person->name }}</td>
                                <td>
                                    <a href="mailto:{{ $person->email }}" class="text-decoration-none">
                                        {{ $person->email }}
                                    </a>
                                </td>
                                <td>{{ (int) $person->supportRequests_count }} aanvragen</td>
                                <td>{{ $person->created_at->format('d/m/Y') }}</td>

                                <td> {{-- Options --}}
                                    <span class="float-right">
                                        <a href="" class="text-decoration-none text-danger">
                                            <i class="fe fe-trash-2"></i>
                                        </a>
                                    </span>
                                </td> {{-- /// Options --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted font-italic">
                                    <i class="fe fe-info mr-1"></i> Er zijn geen hulpbehoevende personen gevonden momenteel.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $persons->links() }} {{-- Pagination view instance --}}
        </div>
    </div>
@endsection
