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

    <div class="container-fluid pb-3">
        <form action="" class="card card-body border-0 shadow-sm">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-list fe-brand mr-2"></i> Inventaris item toevoegen
            </h6>

            @csrf {{-- Form field protection --}}

            <div class="row mt-1">
                <div class="col-md-3">
                    <h5>Algemene gegevens</h5>
                </div>
                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-7">
                            <label for="name">Naam <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name', 'is-invalid')" placeholder="Item naam" id="name" @input('naam')>
                            @error('naam')
                        </div>

                        <div class="form-group col-5">
                            <label for="category">Categorie <span class="text-danger">*</span></label>

                            <select class="form-control @error('categorie', 'is-invalid')" id="category" @input('categorie')>
                                <option value="">--- Selecteer de categorie ---</option>
                                @options($categories, 'categorie', old('categorie'))
                            </select>

                            @error('categorie')
                        </div>

                        <div class="form-group col-8">
                            <label for="storage_loc">Opslag locatie <span class="text-danger">*</span></label>
                            <input id="storage_loc" type="text" class="form-control @error('opslag_locatie', 'is-invalid')" placeholder="Opslag locatie" @input('opslag_locatie')>
                            @error('opslag_locatie')
                        </div>

                        <div class="form-group col-4">
                            <label for="amount">Aantal stuks <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('amount', 'is-invalid')" placeholder="Aantal stuks" @input('aantal') id="amount">
                            @error('aantal')
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-0">

            <div class="row">
                <div class="col-md-3">
                    <h5>Extra informatie</h5>
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="note">Extra informatie en of notitie</label>
                            <textarea id="note" rows="4" class="form-control @error('notitie', 'is-invalid')" @input('notitie') placeholder="Extra informatie of notitie">{{ old('notitie') }}</textarea>
                            @error('notitie')
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-0">

            <div class="form-row">
                <div class="form-group col-12">

                </div>
            </div>
        </form>
    </div>
@endsection
