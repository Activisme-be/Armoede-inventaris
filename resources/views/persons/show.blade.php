@extends('layouts.app', ['title' => $person->name])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Personen</h1>
            <div class="page-subtitle">Algemene informatie van {{ ucfirst($person->name) }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('persons.overview') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-users mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include ('persons._partials._sidenav', ['person' => $person])
            </div>

            <div class="col-9">
                <form action="" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-info fe-brand mr-2"></i> Algemene informatie van {{ ucfirst($person->name) }}
                    </h6>

                    @csrf               {{-- Form field protection --}}
                    @method ('PATCH')
                    @form($person)

                    <fieldset @cannot('update', $person) disabled @endcan>
                        @include ('persons._partials._form')
                    </fieldset>

                    @can ('update', $person) {{-- Can edit the person --}}
                        <hr class="mt-0">

                        <div class="form-row">
                            <div class="form-group col-12 mb-0">
                                <span class="float-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fe fe-save mr-1"></i> Aanpassen
                                    </button>

                                    <button type="reset" class="btn btn-light">
                                        <i class="fe fe-rotate-ccw mr-1 text-danger"></i> Reset
                                    </button>
                                </span>
                            </div>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection
