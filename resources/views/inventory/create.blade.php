@extends ('layouts.app', ['title' => 'Nieuw item'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <div class="page-title">Inventaris</div>
            <div class="page-subtitle">Nieuw item toevoegen</div>

            <div class="page-options d-flex">
                <a href="{{ route('inventory.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>
@endsection
