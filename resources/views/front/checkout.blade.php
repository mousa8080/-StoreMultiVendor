<x-front-layout title="Checkout">
    <x-slot:breadcrumb>
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="breadcrumb-title">Checkout</h2>
                            <ul class="breadcrumb-menu">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li class="active">Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Checkout -->
    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="checkout-steps-form-style-1">
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="checkout-form">
                                        <h3 class="title">Billing Details</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[billing][first_name]" label="First Name"
                                                        :value="auth()->user()->name ?? ''" placeholder="First Name"
                                                        required class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[billing][last_name]" label="Last Name"
                                                        placeholder="Last Name" required class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input type="email" name="addr[billing][email]"
                                                        label="Email Address" :value="auth()->user()->email ?? ''"
                                                        placeholder="Email Address" required class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[billing][phone_number]"
                                                        label="Phone Number" placeholder="Phone Number" required
                                                        class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[billing][street_address]"
                                                        label="Street Address" placeholder="Street Address" required
                                                        class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[billing][city]" label="City"
                                                        placeholder="City" required class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[billing][postal_code]" label="Post Code"
                                                        placeholder="Post Code" class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[billing][state]" label="State"
                                                        placeholder="State" class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[billing][country]"
                                                        label="Country (2 letters)" value="US" placeholder="Country"
                                                        maxlength="2" required class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-checkbox checkbox-style-3">
                                                    <input type="checkbox" id="checkbox-3" checked>
                                                    <label for="checkbox-3"><span></span> Shipping address same as
                                                        billing</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" id="shipping-address" style="display: none;">
                                    <div class="checkout-form">
                                        <h3 class="title">Shipping Details</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[shipping][first_name]" label="First Name"
                                                        placeholder="First Name" class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[shipping][last_name]" label="Last Name"
                                                        placeholder="Last Name" class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input type="email" name="addr[shipping][email]"
                                                        label="Email Address" placeholder="Email Address"
                                                        class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[shipping][phone_number]"
                                                        label="Phone Number" placeholder="Phone Number"
                                                        class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[shipping][street_address]"
                                                        label="Street Address" placeholder="Street Address"
                                                        class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[shipping][city]" label="City"
                                                        placeholder="City" class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[shipping][postal_code]" label="Post Code"
                                                        placeholder="Post Code" class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[shipping][state]" label="State"
                                                        placeholder="State" class="form-input" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <x-form.input name="addr[shipping][country]"
                                                        label="Country (2 letters)" value="US" placeholder="Country"
                                                        maxlength="2" class="form-input" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="checkout-payment-form">
                                        <h3 class="title">Payment Method</h3>
                                        <div class="payment-method-accordion">
                                            <div class="single-method">
                                                <input type="radio" name="payment_method" value="cash_on_delivery"
                                                    id="payment-3" checked>
                                                <label for="payment-3">
                                                    <span></span>
                                                    Cash on Delivery
                                                </label>
                                            </div>
                                            <div class="single-method">
                                                <input type="radio" name="payment_method" value="credit_card"
                                                    id="payment-1">
                                                <label for="payment-1">
                                                    <span></span>
                                                    Credit Card
                                                </label>
                                            </div>
                                            <div class="single-method">
                                                <input type="radio" name="payment_method" value="paypal" id="payment-2">
                                                <label for="payment-2">
                                                    <span></span>
                                                    PayPal
                                                </label>
                                            </div>
                                        </div>
                                        @error('payment_method')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="checkout-form-action">
                                        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="checkout-sidebar-coupon">
                            <p>Have a Coupon Code? <a href="javascript:void(0)" data-bs-toggle="collapse"
                                    data-bs-target="#coupon-collapse">Click here</a></p>
                            <div class="collapse" id="coupon-collapse">
                                <div class="coupon-form">
                                    <input type="text" placeholder="Enter Coupon Code">
                                    <button class="btn">Apply</button>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-sidebar-price-table mt-30">
                            <h5 class="title">Order Summary</h5>

                            <div class="sub-total-price">
                                @foreach($card->get() as $item)
                                    <div class="total-price">
                                        <p class="value">{{ $item->product->name }} (x{{ $item->quantity }})</p>
                                        <p class="price">${{ number_format($item->product->price * $item->quantity, 2) }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Subtotal:</p>
                                    <p class="price">${{ number_format($card->total(), 2) }}</p>
                                </div>
                                <div class="payable-price">
                                    <p class="value">Shipping:</p>
                                    <p class="price">Free</p>
                                </div>
                            </div>

                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value fw-bold">Total:</p>
                                    <p class="price fw-bold">${{ number_format($card->total(), 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-sidebar-banner mt-30">
                            <a href="{{ route('products') }}">
                                <img src="{{ asset('assets/images/banner/banner.jpg') }}" alt="#">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Checkout -->

    <style>
        .checkout-wrapper {
            padding: 60px 0;
        }

        .checkout-form {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .checkout-form h3.title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .single-form {
            margin-bottom: 20px;
        }

        .single-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: #333;
        }

        .form-input input {
            width: 100%;
            height: 50px;
            padding: 0 20px;
            border: 1px solid #eee;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-input input:focus {
            border-color: #0d6efd;
            outline: none;
        }

        .single-checkbox {
            margin: 20px 0;
        }

        .single-checkbox input[type="checkbox"] {
            display: none;
        }

        .single-checkbox label {
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            font-size: 14px;
            user-select: none;
        }

        .single-checkbox label span {
            position: absolute;
            left: 0;
            top: 2px;
            width: 18px;
            height: 18px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .single-checkbox input[type="checkbox"]:checked+label span:after {
            content: '';
            position: absolute;
            left: 5px;
            top: 2px;
            width: 6px;
            height: 10px;
            border: solid #0d6efd;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .checkout-payment-form {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .checkout-payment-form h3.title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .single-method {
            margin-bottom: 15px;
        }

        .single-method input[type="radio"] {
            display: none;
        }

        .single-method label {
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            font-size: 14px;
            user-select: none;
            display: block;
            padding: 12px 12px 12px 40px;
            border: 1px solid #eee;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .single-method label:hover {
            border-color: #0d6efd;
        }

        .single-method label span {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            border: 2px solid #ddd;
            border-radius: 50%;
        }

        .single-method input[type="radio"]:checked+label {
            border-color: #0d6efd;
            background: #f8f9ff;
        }

        .single-method input[type="radio"]:checked+label span:after {
            content: '';
            position: absolute;
            left: 4px;
            top: 4px;
            width: 10px;
            height: 10px;
            background: #0d6efd;
            border-radius: 50%;
        }

        .checkout-form-action {
            margin-top: 20px;
        }

        .checkout-form-action .btn {
            width: 100%;
            height: 55px;
            font-size: 16px;
            font-weight: 600;
        }

        .checkout-sidebar {
            position: sticky;
            top: 20px;
        }

        .checkout-sidebar-coupon {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .checkout-sidebar-coupon p {
            margin: 0;
            font-size: 14px;
        }

        .checkout-sidebar-coupon a {
            color: #0d6efd;
            text-decoration: none;
        }

        .coupon-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .coupon-form input {
            flex: 1;
            height: 45px;
            padding: 0 15px;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .coupon-form .btn {
            height: 45px;
            padding: 0 25px;
        }

        .checkout-sidebar-price-table {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .checkout-sidebar-price-table h5.title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .sub-total-price {
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
        }

        .total-price {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .total-price .value {
            color: #666;
        }

        .total-price .price {
            font-weight: 500;
            color: #333;
        }

        .payable-price {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .payable-price .value.fw-bold {
            font-size: 18px;
            font-weight: 700;
        }

        .payable-price .price.fw-bold {
            font-size: 18px;
            font-weight: 700;
            color: #0d6efd;
        }

        .checkout-sidebar-banner {
            border-radius: 8px;
            overflow: hidden;
        }

        .checkout-sidebar-banner img {
            width: 100%;
            height: auto;
        }
    </style>

    @push('scripts')
        <script>
            document.getElementById('checkbox-3').addEventListener('change', function () {
                const shippingSection = document.getElementById('shipping-address');
                const shippingInputs = shippingSection.querySelectorAll('input');

                if (this.checked) {
                    shippingSection.style.display = 'none';
                    shippingInputs.forEach(input => input.removeAttribute('required'));
                } else {
                    shippingSection.style.display = 'block';
                    shippingInputs.forEach(input => {
                        if (!input.name.includes('email') && !input.name.includes('postal_code') && !input.name.includes('state')) {
                            input.setAttribute('required', 'required');
                        }
                    });
                }
            });
        </script>
    @endpush
</x-front-layout>