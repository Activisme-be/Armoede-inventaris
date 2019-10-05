@extends('layouts.app', ['title' => 'Verwijder ' . $item->naam])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">{{ $item->naam }} <span class="small font-weight-bold font-italic">(#{{ $item->product_code }})</span> als inventaris item verwijderen</div>

            <div class="page-options">
                <a href="{{ route('inventory.index') }}" class="btn shadow-sm btn-secondary">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include ('inventory._partials._sidenav', ['item' => $item])
            </div>

            <div class="col-9">
                <form action="{{ route('inventory.item.delete', $item) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-trash-2 fe-brand mr-2"></i>  Inventaris item verwijderen
                    </h6>

                    @csrf {{-- Form field protection --}}
                    @method ('DELETE') {{-- Method sppofing --}}

                    <p class="card-text text-danger">
                        <i class="fe fe-info mr-2"></i> U staat op het punt om {{ ucfirst($item->naam) }} te verwijderen uit de inventaris.
                    </p>

                    <p class="card-text">
                        U staat op het punt om een inventaris punt te verwijderen in de applicatie. Kan dit niet ongedaan gemaakt worden. <br>
                        Dus weer zeker voor het item definitief wordt verwijderd in de applicatie. Deze actie is niet meer terug te draaien.
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-danger">
                                <i class="fe fe-trash-2 mr-1"></i> Verwijder
                            </button>

                            <a href="{{ route('inventory.item', $item) }}" class="btn btn-light">
                                <i class="fe fe-rotate-ccw mr-1 text-danger"></i> Annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
