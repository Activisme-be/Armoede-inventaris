@extends ('layouts.app', ['title' => 'Personen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Personen</h1>
            <div class="page-subtitle">Overzicht van hulpbehoevende personen</div>

            <div class="d-flex page-options">
                <a href="" class="btn btn-secondary shadow-sm">
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

            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>

                    </thead>
                </table>
            </div>

            {{ $persons->links() }} {{-- Pagination view instance --}}
        </div>
    </div>
@endsection
