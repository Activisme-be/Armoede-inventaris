@extends ('layouts.app', ['title' => 'Categorie toevoegen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Categorieen</h1>
            <div class="page-subtitle">Categorie toevoegen</div>

            <div class="page-options d-flex">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form action="{{ route('categories.store') }}" method="POST" class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-plus fe-brand mr-2"></i> Categorie toevoegen
            </h6>

            @csrf {{-- Form field protection --}}

            <div class="form-row">
                <div class="form-group col-7">
                    <label for="name">Naam <span class="text-danger">*</span></label>
                    <input id="name" type="text" class="form-control @error('naam', 'is-invalid')" placeholder="Category naam" @input('naam')>
                    @error('naam')
                </div>

                <div class="form-group col-12">
                    <label for="beschrijving">Beschrijving</label>
                    <textarea class="form-control @error('beschrijving', 'is-invalid')" placeholder="Beschrijving van de categorie" rows="5">{{ old('beschrijving') }}</textarea>
                </div>
            </div>

            <hr class="mt-0">

            <div class="form-row">
                <div class="form-group col-12 mb-0">
                    <button type="submit" class="btn btn-success">
                        <i class="fe fe-save mr-1"></i> Toevoegen
                    </button>

                    <button type="reset" class="btn btn-light">
                        <i class="fe fe-rotate-ccw mr-1 text-danger"></i> Annuleren
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
