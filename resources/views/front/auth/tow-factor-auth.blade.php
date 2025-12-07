<x-front-layout title="Two-Factor-Authentication">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Two-Factor-Authentication</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 400px;">
            <div class="w-100" style="max-width: 500px;">
                <form class="form" method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf
                    <div class="card shadow-sm">
                        @if (session('status') == 'two-factor-authentication-confirmed')
                        <div class="mb-4 font-medium text-sm">
                            Two-factor authentication confirmed and enabled successfully.
                        </div>
                        @endif
                        <div class="card-body text-center">
                            <h3 class="mb-3">Two-Factor Authentication</h3>
                            <p class="text-muted mb-4">You can enable or disable 2FA for your account.</p>
                            @if( !Auth::user()->two_factor_secret )
                            <button type="submit" class="btn btn-primary w-100">Enable Two-Factor Authentication</button>
                            @else
                            <div class="p-4">
                                {!! Auth::user()->twoFactorQrCodeSvg() !!}
                            </div>
                            <h3>Recover Code</h3>
                            <p class="text-muted mb-4">You can enable or disable 2FA for your account.</p>
                            @foreach (Auth::user()->recoveryCodes() as $code)
                                <p>{!! $code !!}</p>
                            @endforeach
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">Disable Two-Factor Authentication</button>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-front-layout>