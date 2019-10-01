@extends ('layouts.app', ['title' => "#{$item->product_code} {$item->naam}"])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">
                Algemene informatie omtrent {{ $item->naam }} <span class="small font-weight-bold font-italic">(#{{ $item->product_code }})</span>
            </div>

            <div class="page-options flex">
                <a href="{{ route('inventory.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3">
                @include ('inventory._partials._sidenav', ['item' => $item])
            </div>

            <div class="col-md-9">
                <form method="POST" action="{{ route('inventory.item.update', $item) }}" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-info fe-brand mr-2"></i> Algemene informatie
                    </h6>

                    @csrf               {{-- Form field protection --}}
                    @method('PATCH')    {{-- HTTP method spoofing --}}
                    @form($item)        {{-- Bind data to the form --}}

                    @include('flash::message') {{-- Flash session view partial --}}

                    <fieldset @cannot ('edit', $item) disabled @endcan>
                        <div class="row mt-1">
                            <div class="col-md-3">
                                <h5>Algemene gegevens</h5>
                            </div>
                            <div class="offset-1 col-8">
                                <div class="form-row">
                                    <div class="form-group col-7">
                                        <label for="name">Naam <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('naam', 'is-invalid')" placeholder="Item naam" id="name" @input('naam')>
                                        @error('naam')
                                    </div>

                                    <div class="form-group col-5">
                                        <label for="category">Categorie <span class="text-danger">*</span></label>

                                        <select class="form-control @error('categorie', 'is-invalid')" id="category" @input('categorie')>
                                            <option value="">Geen categorie opgegeven</option>

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($category->id === $item->category_id || $category->id == old('categorie')) selected @endif>
                                                    {{ ucfirst($category->naam) }}
                                                </option>
                                            @endforeach
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
                                        <input type="text" class="form-control @error('aantal', 'is-invalid')" placeholder="Aantal stuks" @input('aantal') id="amount">
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

                        @can('edit', $item)
                            <hr class="mt-0">

                            <div class="form-row">
                                <div class="form-group col-12 mb-0">
                                <span class="float-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fe fe-save mr-1"></i> Opslaan
                                    </button>

                                    <button type="reset" class="btn btn-light">
                                        <i class="fe fe-rotate-ccw text-danger mr-1"></i> Reset
                                    </button>
                                </span>
                                </div>
                            </div>
                        @endcan
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
