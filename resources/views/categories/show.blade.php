@extends ('layouts.app', ['title' => $category->naam])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Categorieen</h1>
            <div class="page-subtitle">Algemene informatie omtrent {{ $category->naam }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3"> {{-- Sidenav --}}
                @include ('categories._partials._sidenav', ['category' => $category])
            </div> {{-- /// Sidenav --}}

            <div class="col-md-9">
                <form action="" method="POST" class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-tag fe-brand fe-info mr-2"></i> Algemene informatie omtrent {{ $category->naam }}
                    </h6>

                    @csrf {{-- Form field protection --}}
                </form>
            </div>
        </div>
    </div>
@endsection
