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

                    @csrf               {{-- Form field protection --}}
                    @method ('PATCH')   {{-- HTTP method spoofing --}}
                    @form($category)    {{-- Bind data to the form --}}

                    <fieldset @cannot('edit', $category) disabled @endcan>
                        <div class="form-row">
                            <div class="form-group col-7">
                                <label for="name">Naam @can ('edit', $category) <span class="text-danger">*</span> @endcan </label>
                                <input id="name" type="text" class="form-control @error('naam', 'is-invalid')" placeholder="Category naam" @input('naam')>
                                @error('naam')
                            </div>

                            <div class="form-group col-12 @cannot ('edit', $category) mb-0 @endcan">
                                <label for="beschrijving">Beschrijving</label>
                                <textarea class="form-control @error('beschrijving', 'is-invalid')" placeholder="Beschrijving van de categorie" rows="5">{{ old('beschrijving') }}</textarea>
                            </div>
                        </div>
                    </fieldset>

                    @can ('edit', $category) {{-- Authententicated user is permitted to perform the action --}}
                        <hr class="mt-0">

                        <div class="mt-0">
                            <div class="form-row">
                                <div class="form-group col-12 mb-0">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fe fe-save mr-1"></i> Wijzigen
                                    </button>

                                    <button class="btn btn-light" type="reset">
                                        <i class="fe text-danger fe-rotate-ccw mr-1"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection
