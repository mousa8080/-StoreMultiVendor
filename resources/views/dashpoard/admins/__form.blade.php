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
    <x-form.input label="Admin Name" name="name" type="text" :value="$admin->name" />
</div>

<div class="form-group mb-3">
    <x-form.input label="Email" name="email" type="email" :value="$admin->email" />
</div>

<div class="form-group mb-3">
    <x-form.input label="Password" name="password" type="password" />
    @if(isset($admin->id))
        <small class="text-muted">Leave empty to keep current password</small>
    @endif
</div>

<fieldset class="mb-3">
    <legend>Roles</legend>
    @foreach ($roles as $role)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}"
                @checked(in_array($role->id, old('roles', $admin->roles->pluck('id')->toArray())))>
            <label class="form-check-label" for="role_{{ $role->id }}">
                {{ $role->name }}
            </label>
        </div>
    @endforeach
</fieldset>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Create' }}</button>
    <a href="{{ route('dashpoard.admins.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</div>