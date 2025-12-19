@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group mb-3">
    <x-form.input label="roles Name" class="form-control-lg" role="input" name="name" type="text"
        :value="$role->name" />
</div>
<fieldset>
    <legend>Abilities</legend>
    <div class="row mb-2">
        @foreach ($abilities as $ability_code => $ability_name)
            <div class="col-md-6">
                {{$ability_name}}
            </div>
            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="allow"
                    @checked(old("abilities.$ability_code", $role_abilities[$ability_code] ?? '') == 'allow')>
                allow
            </div>
            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="deny"
                    @checked(old("abilities.$ability_code", $role_abilities[$ability_code] ?? '') == 'deny')>
                deny
            </div>
            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="inherit"
                    @checked(old("abilities.$ability_code", $role_abilities[$ability_code] ?? '') == 'inherit')>
                inherit
            </div>
        @endforeach

</fieldset>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Create' }}</button>
    <a href="{{ route('dashpoard.roles.index') }}" class="btn btn-secondary ms-2-pinary">Cancel</a>
</div>