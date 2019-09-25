@extends ('layouts.app', ['title' => 'Categorieen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Categorieen</h1>
            <div class="page-subtitle">Overzicht van de item categorieen</div>

            <div class="d-flex page-options">
                <a href="{{ route('categories.create') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search-xl ml-2">
                    <input type="text" class="form-search-xl border-0 form-control" @input('term') placeholder="Zoeken op naam">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card card-body border-0 shadow-sm">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-tag fe-brand mr-2"></i> Overzicht van item categorieen
            </h6>

            @include ('flash::message') {{-- Flash session view partial --}}

            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-top-0 text-muted" scope="col">#</th>
                            <th class="border-top-0" scope="col">Toegevoegd door</th>
                            <th class="border-top-0" scope="col">Naam</th>
                            <th class="border-top-0" scope="col">Items</th>
                            <th class="border-top-0" scope="col">Toegevoegd op</th>
                            <th class="border-top-0" scope="col">&nbsp;</th> {{-- Column dedicated for the functions only --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category) {{-- Loop trough the categories --}}
                            <tr>
                                <td class="font-weight-bold text-muted">#{{ $category->id }}</td>
                                <td>{{ $category->creator->name ?? config('app.name') }}</td>
                                <td>{{ $category->naam }}</td>
                                <td>{{ $category->items_count }} items</td>
                                <td>{{ $category->created_at->format('d/m/Y') }}</td>

                                <td> {{-- Shortcuts for the functiond --}}
                                    <span class="float-right">
                                        <a href="{{ route('category.show', $category) }}" class="text-decoration-none text-muted">
                                            <i class="fe fe-eye"></i>
                                        </a>

                                        @can ('delete', $category) {{-- Auth user is authorized to delete the category --}}
                                            <a href="{{ route('categories.destroy', $category) }}" class="text-decoration-none text-danger ml-1">
                                                <i class="fe fe-trash-2"></i>
                                            </a>
                                        @endcan
                                    </span>
                                </td> {{-- /// END shortcuts --}}
                            </tr>
                        @empty {{-- There are no categories found in the application --}}
                            <tr>
                                <td class="text-muted" colspan="6">
                                    <i class="fe fe-info mr-1"></i> Er zijn momenteel geen categorieen gevonden in de applicatie.
                                </td>
                            </tr>
                        @endforelse {{-- /// END loop --}}
                    </tbody>
                </table>
            </div>

            {{ $categories->links() }} {{-- Pagination view instance --}}
        </div>
    </div>
@endsection
