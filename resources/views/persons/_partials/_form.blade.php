<div class="row">
    <div class="col-4">
        <h5>Algemene informatie</h5>
    </div>

    <div class="col-8">
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

    <div class="col-8">
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
