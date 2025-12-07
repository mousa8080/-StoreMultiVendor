<x-front-layout title="2fa challenge">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">2fa challenge</li>

            </ol>
        </nav>
        <div class="d-flex flex-column gap-3 account-form  mx-auto mt-5">
            <form class="form" method="POST" action="{{ route('two-factor.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label required-label" for="email">2fa code</label>
                    <input type="text" class="form-control" name="code" id="email" required>
                    @if($errors->has('code'))
                        <div class="text-danger mt-1">{{ $errors->first('code') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="email">recovery code</label>
                    <input type="text" class="form-control" name="recovery_code" id="email" required>
                    @if($errors->has('recovery_code'))
                        <div class="text-danger mt-1">{{ $errors->first('recovery_code') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">submit</button>
            </form>
        </div>
    </div>
</x-front-layout>