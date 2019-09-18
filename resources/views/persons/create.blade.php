@extends ('layouts.app', ['title' => 'Personen'])

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Personen</h1>
            <div class="page-subtitle">Hulpbehoevende persoon toevoegen</div>

            <div class="page-options d-flex">
                <a href="{{ route('persons.overview') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-users mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form action="{{ route('persons.store') }}" method="POST" class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-plus fe-brand mr-2"></i> Hulpbehoevende persoon toevoegen
            </h6>

            @csrf {{-- Form field protection --}}

            <div class="row">
                <div class="col-4">
                    <h5>Algemene informatie</h5>
                </div>

                <div class="offset-1 col-7">
                    <div class="form-row">
                        <div class="form-group col-5">
                            <label for="firstname">Voornaam <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('voornaam', 'is-invalid')" id="firstname" placeholder="Voornaam" @input('voornaam')>
                            @error('voornaam')
                        </div>

                        <div class="form-group col-7">
                            <label for="lastname">Achternaam <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('achternaam', 'is-invalid')" id="lastname" placeholder="Achternaam" @input('achternaam')>
                            @error('achternaam')
                        </div>

                        <div class="form-group col-6">
                            <label for="email">Email adres <span class="text-danger">*</span></label>
                            <input type="text" id="email" class="form-control @error('email', 'is-invalid')" placeholder="Email adres" @input('email')>
                            @error('email')
                        </div>

                        <div class="form-group col-6">
                            <label for="phone">Tel. nr</label>
                            <input type="text" id="phone" class="form-control @error('telefoon_nummer', 'is-invalid')" placeholder="Telefoon nummer" @input('telefoon_nummer')>
                            @error('telefoon_nummer')
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-0">

            <div class="row">
                <div class="col-4">
                    <h5>Adres gegevens</h5>
                </div>

                <div class="offset-1 col-7">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="street">Straat + huisnummer</label>
                            <input type="text" id="street" class="form-control" placeholder="Straat + huisnummer" @input('straat_huisnummer')>
                        </div>

                        <div class="form-group col-4">
                            <label for="postal">Postcode</label>
                            <input type="text" id="postal" class="form-control" placeholder="Postcode" @input('postcode')>
                        </div>

                        <div class="form-group col-4">
                            <label for="city">Stad / Gemeente</label>
                            <input type="text" id="city" class="form-control" placeholder="Stad / Gemeente" @input('stad_of_gemeente')>
                        </div>

                        <div class="form-group col-4">
                            <label for="country">Land</label>
                            <input type="text" id="city" class="form-control" placeholder="Land" @input('land')>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-0">

            <div class="form-row">
                <div class="form-group col-12 mb-0">
                    <span class="float-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fe fe-save mr-1"></i> Opslaan
                        </button>

                        <button type="reset" class="btn btn-light">
                            <i class="fe fe-rotate-ccw mr-1 text-danger"></i> Reset
                        </button>
                    </span>
                </div>
            </div>

        </form>
    </div>
@endsection
