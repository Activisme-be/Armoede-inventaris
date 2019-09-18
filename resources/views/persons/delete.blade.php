@extends ('layouts.app', ['title' => $person->name])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Personen</h1>
            <div class="page-subtitle">{{ ucfirst($person->name) }} verwijderen in de applicatie.</div>

            <div class="page-options d-flex">
                <a href="{{ route('persons.overview') }}" class="btn btn-secondary">
                    <i class="fe fe-users mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3">
                @include ('persons._partials._sidenav', ['person' => $person])
            </div>
            <div class="col-9">
                <form action="{{ route('persons.delete', $person) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-trash-2 fe-brand mr-2"></i> {{ ucfirst($person->name) }} verwijderen in de applicatie.
                    </h6>

                    @csrf               {{-- Form field protection --}}
                    @method ('DELETE')  {{-- HTTP method spoofing --}}

                    <p class="card-title text-danger">
                        <i class="fe fe-info mr-2"></i>
                        U staat op het punt om <span class="font-weight-bolder">{{ $person->name }}</span> te verwijderen als hulpbehoevende persoon in de applicatie.
                    </p>

                    <p class="card-title">
                        Bij het verijderen van de persoon worden alle gegevens verwijderen. Inclusief zijn aanvragen en informatie omtrent verstrekte hulp. <br>
                        Let wel op deze actie kan men niet terugdraaien in de applicatie. Dus weet zeker of u de persoon wilt verwijderen.
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-danger">
                                <i class="fe fe-trash-2 mr-1"></i> Verwijderen
                            </button>

                            <a href="{{ route('persons.overview') }}" class="btn btn-light">
                                <i class="fe fe-rotate-ccw text-danger"></i> Annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
