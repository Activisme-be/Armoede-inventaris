@extends ('layouts.app', ['title' => "#{$item->product_code} {$item->naam}"])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">
                Algemene informatie omtrent {{ $item->naam }} <span class="small font-weight-bold font-italic">(#{{ $item->product_code }})</span>
            </div>

            <div class="page-options flex">
                <a href="{{ route('inventory.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3">
                @include ('inventory._partials._sidenav', ['item' => $item])
            </div>
        </div>
    </div>
@endsection
