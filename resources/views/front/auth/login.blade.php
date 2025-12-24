<x-front-layout title="Login">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">login</li>
            </ol>
        </nav>
        <div class="d-flex flex-column gap-3 account-form  mx-auto mt-5">
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label required-label" for="email">Email</label>
                    <input type="text" class="form-control" name="{{ Config('fortify.username') }}" id="email" required>
                    @error(Config('fortify.username'))
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="password">password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" value="1" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    @if(Route::has('password.request'))
                        <a class="link" href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <div class="d-flex align-items-center my-4">
                <hr class="flex-grow-1">
                <span class="px-3 text-muted">Or continue with</span>
                <hr class="flex-grow-1">
            </div>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('auth.social.redirect', 'google') }}" class="btn btn-social btn-google"
                    title="Login with Google">
                    <i class="fab fa-google me-2"></i> Google
                </a>
                <a href="{{ route('auth.social.redirect', 'facebook') }}" class="btn btn-social btn-facebook"
                    title="Login with Facebook">
                    <i class="fab fa-facebook-f me-2"></i> Facebook
                </a>
                <a href="{{ route('auth.social.redirect', 'twitter') }}" class="btn btn-social btn-twitter"
                    title="Login with Twitter">
                    <i class="fab fa-twitter me-2"></i> Twitter
                </a>
            </div>

            <style>
                .btn-social {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 10px 20px;
                    border-radius: 8px;
                    font-weight: 500;
                    transition: all 0.3s ease;
                    border: none;
                    color: #fff;
                    min-width: 130px;
                }

                .btn-social:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    color: #fff;
                }

                .btn-google {
                    background: linear-gradient(135deg, #ea4335, #dd2c1a);
                }

                .btn-google:hover {
                    background: linear-gradient(135deg, #dd2c1a, #c41e0a);
                }

                .btn-facebook {
                    background: linear-gradient(135deg, #1877f2, #0d65d9);
                }

                .btn-facebook:hover {
                    background: linear-gradient(135deg, #0d65d9, #0a52b5);
                }

                .btn-twitter {
                    background: linear-gradient(135deg, #1da1f2, #0d8ddb);
                }

                .btn-twitter:hover {
                    background: linear-gradient(135deg, #0d8ddb, #0a7ac2);
                }
            </style>

            @if(Route::has('register'))
                <div class="d-flex justify-content-center gap-2 flex-column flex-lg-row flex-md-row flex-sm-column">
                    <span>don't have an account?</span><a class="link" href="{{ route('register') }}">create account</a>
                </div>
            @endif
        </div>

    </div>
</x-front-layout>