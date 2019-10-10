@extends ('layouts.app', ['title' => 'Items inboeken'])

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">Items inboeken voor {{ $item->naam }} <span class="small font-weight-bold font-italic">(#{{ $item->product_code }})</span></div>

            <div class="page-options d-flex">
                <a href="{{ route('inventory.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                @include ('inventory._partials._sidenav', ['item' => $item])
            </div> {{-- // END sidebar --}}

            <div class="col-9">
                <form action="" method="POST" class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-plus fe-brand mr-2"></i> Items toevoegen voor <span class="font-weight-bold">{{ ucfirst($item->naam) }}</span>
                    </h6>

                    <div class="form-row">
                        <div class="col-7 form-group">
                            <label for="item">Item code + naam</label>
                            <input type="text" disabled class="form-control" value="#{{ $item->product_code }} - {{ $item->naam }}">
                        </div>

                        <div class="col-5 form-group">
                            <label for="amount">Het aantal items dat je wilt toevoegen <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('aantal', 'is-invalid')" placeholder="Aantal" @input('aantal')>
                            @error('aantal')
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-success">
                                <i class="fe fe-plus mr-1"></i> Toevoegen
                            </button>

                            <button type="reset" class="btn btn-light">
                                <i class="fe fe-rotate-ccw mr-1 text-danger"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
