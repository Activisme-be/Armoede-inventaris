@extends ('layouts.app', ['title' => 'Inventaris'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <form method="GET" action="" class="border-0 shadow-sm form-search-xl ml-2">
                    <input type="text" class="form-search-xl border-0 form-control" @input('term') placeholder="Zoeken op naam of item code">
                </form>

                <div class="btn-group shadow-sm ml-2" role="group" aria-label="Inventaris opties">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe fe-plus mr-2"></i> Inboeken
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{ route('inventory.create') }}">Nieuw item</a>
                            <a class="dropdown-item" href="#">Bestaand item</a>
                        </div>
                    </div>
                    <a href="" class="btn btn-secondary">
                        <i class="fe fe-minus mr-2"></i> Uitboeken
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-list fe-brand mr-2"></i> Inventaris overzicht
            </h6>

            @include ('flash::message') {{-- Flash session view partial --}}

            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-muted border-top-0" scope="col">Item code</th>
                            <th class="border-top-0" scope="col">Status</th>
                            <th class="border-top-0" scope="col">Naam</th>
                            <th class="border-top-0" scope="col">Categorie</th>
                            <th class="border-top-0" scope="col">Opslag locatie</th>
                            <th class="border-top-0" scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item) {{-- Loop trough the inventory items --}}
                            <tr>
                                <td class="text-muted font-weight-bold">#{{ $item->product_code }}</td>
                                <td> {{-- Status indicator --}}
                                    @if ($item->isLow())
                                        <span class="badge-danger">Lage voorraad</span>
                                    @elseif($item->isNormal())
                                        <span class="badge badge-success">Normale voorraad</span>
                                    @elseif($item->isHigh())
                                        <span class="badge badge-primary">Hoge voorraad</span>
                                    @else {{-- Item amount unknown --}}
                                        <span class="badge badge-dark">Onbekend</span>
                                    @endif
                                </td> {{-- /// End status indicator --}}
                                <td>{{ $item->category->naam ?? 'Onbekend' }}</td>
                                <td>{{ $item->naam }}</td>
                                <td>{{ $item->opslag_locatie }}</td>

                                <td> {{-- Item function shortcuts --}}
                                    <span class="float-right">
                                        <a href="{{ route('inventory.item', $item) }}" class="text-secondary text-decoration-none">
                                            <i class="fe fe-eye"></i>
                                        </a>

                                        @can ('delete', $item) {{-- Check if the user is permitted for the operation. --}}
                                            <a href="{{ route('inventory.item.delete', $item) }}" class="text-danger text-decoration-none ml-1">
                                                <i class="fe fe-trash-2"></i>
                                            </a>
                                        @endcan
                                    </span>
                                </td> {{-- /// END item function shortcuts --}}
                            </tr>
                        @empty {{-- There are no items found in the inventory --}}
                            <tr>
                                <td class="text-muted" colspan="6">
                                    <i class="fe fe-info mr-1"></i> Er zijn momenteel geen items opgenomen in de inventaris
                                </td>
                            </tr>
                        @endforelse {{-- /// END item loop --}}
                    </tbody>
                </table>
            </div>

            {{ $items->links() }} {{-- Pagination view instance --}}
        </div>
    </div>
@endsection
