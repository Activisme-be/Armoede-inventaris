@extends ('layouts.app', ['title' => 'Categorie verwijderen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Categorieen</h1>
            <div class="page-subtitle">{{ ucfirst($category->naam) }} verwijderen als categorie in de applicatie.</div>

            <div class="page-options d-flex">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3">
                @include ('categories._partials._sidenav', ['category' => $category])
            </div>

            <div class="col-md-9">
                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-trash-2 fe-brand mr-2"></i> {{ ucfirst($category->naam) }} verwijderen als categorie in de applicatie.
                    </h6>

                    @csrf             {{-- Form field protection --}}
                    @method('DELETE') {{-- HTTP method spoofing --}}

                    <p class="card-text text-danger">
                        U staat op het punt om <span class="font-weight-bold">{{ ucfirst($category->naam) }}</span> te verwijderen als item categorie.
                    </p>

                    <p class="card-text">
                        Bij het verwijderen van de categorie zullen deze worden losgekoppeld worden. Dus daarom vragen wij u zeker te
                        zijn of u deze categorie definitief wilt verwijderen. De verwijdering kan ook niet ongedaan worden gemaakt in de applicatie.
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-danger">
                                <i class="fe fe-trash-2 mr-1"></i> Verwijderen
                            </button>

                            <a href="{{ route('category.show', $category) }}" class="btn btn-light">
                                <i class="fe fe-rotate-ccw text-danger mr-1"></i> Annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
