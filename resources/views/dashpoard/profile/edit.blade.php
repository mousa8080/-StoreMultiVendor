@extends('layouts.dashposrd')

@section('title', 'categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">edit profile</li>
@endsection

@section('content')
    <x-alert type="success" />
    <form action="{{ route('dashpoard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="mb-3">
            <x-form.input type="text" name="first_name" id="first_name" label="first name"
                :value="$user->profile->first_name" />
        </div>
        <div class="mb-3">
            <x-form.input type="text" name="last_name" id="last_name" label="last name"
                :value="$user->profile->last_name" />
        </div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="">Select Gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ 'male' }}</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ 'female' }}</option>
            </select>
        </div>
        <div class="mb-3">
            <x-form.input type="number" name="phone" id="phone" label="phone" :value="$user->profile->phone" />
        </div>
        <div class="mb-3">
            <x-form.input type="text" name="street_name" id="street_name" label="street name"
                :value="$user->profile->street_name" />
        </div>
        <div class="mb-3">
            <x-form.input type="text" name="city" id="city" label="city" :value="$user->profile->city" />
        </div>
        <div class="mb-3">
            <label>Country</label>
            <select name="country" id="country" class="form-control">
                <option value="">Select Country</option>
                @foreach($countries as $code => $name)
                    <option value="{{ $code }}" {{ old('country') == $code ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Locale</label>
            <select name="locale" id="locale" class="form-control">
                <option value="">Select Locale</option>
                @foreach($locales as $code => $name)
                    <option value="{{ $code }}" {{ old('locale') == $code ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection