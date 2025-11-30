<x-front-layout title="Shopping Cart">
    <x-slot:breadcrumb>
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="breadcrumb-title">Shopping Cart</h2>
                            <ul class="breadcrumb-menu">
                                <li><a href="#">Home</a></li>
                                <li class="active">Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="lni lni-checkmark-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="cart-list-head">
                @if($card->get()->count() > 0)
                    <!-- Cart List Title -->
                    <div class="cart-list-title">
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-12"></div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <p>Product Name</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>Quantity</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>Price</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>Subtotal</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <p>Remove</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Cart List Title -->

                    <!-- Cart Single List -->
                    @foreach($card->get() as $item)
                        <div class="cart-single-list">
                            <div class="row align-items-center">
                                <div class="col-lg-1 col-md-1 col-12">
                                    <a href="#">
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-3 col-12">
                                    <h5 class="product-name">
                                        <a href="#">
                                            {{ $item->product->name }}
                                        </a>
                                    </h5>
                                    @if($item->product->store)
                                        <p class="product-des">
                                            <span><em>Store:</em> {{ $item->product->store->name }}</span>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <form action="{{ route('card.update', $item->id) }}" method="POST"
                                        class="cart-quantity-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <div class="input-group">
                                            <input type="number" name="quantity" class="form-control"
                                                value="{{ $item->quantity }}" min="1" style="max-width: 80px;">
                                            <button type="submit" class="btn btn-sm btn-primary ms-1">
                                                <i class="lni lni-checkmark"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>${{ number_format($item->product->price, 2) }}</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p class="fw-bold">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <form action="{{ route('card.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="lni lni-close"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Cart Single List -->

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="total-amount">
                                <div class="row">
                                    <div class="col-lg-8 col-md-6 col-12">
                                        <div class="left">
                                            <div class="coupon">
                                                <form action="#" target="_blank">
                                                    <input name="Coupon" placeholder="Enter Your Coupon">
                                                    <div class="button">
                                                        <button class="btn">Apply Coupon</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="right">
                                            <ul>
                                                <li>Cart Subtotal<span>${{ number_format($card->total(), 2) }}</span></li>
                                                <li>Shipping<span>Free</span></li>
                                                <li class="last">You Pay<span>${{ number_format($card->total(), 2) }}</span>
                                                </li>
                                            </ul>
                                            <div class="button">
                                                <a href="#" class="btn"
                                                    onclick="alert('Checkout coming soon!'); return false;">Checkout</a>
                                                <a href="{{ route('home') }}" class="btn btn-alt">Continue
                                                    shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Empty Cart -->
                    <div class="empty-cart text-center py-5">
                        <i class="lni lni-cart" style="font-size: 80px; color: #ddd;"></i>
                        <h3 class="mt-3">Your cart is empty</h3>
                        <p class="text-muted">Looks like you haven't added anything to your cart yet</p>
                        <a href="#" class="btn btn-primary mt-3">
                            Continue Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Shopping Cart -->

    <style>
        .shopping-cart {
            padding: 60px 0;
        }

        .cart-list-title {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .cart-list-title p {
            font-weight: 600;
            margin: 0;
            color: #333;
        }

        .cart-single-list {
            background: #fff;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .cart-single-list:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .product-name a {
            color: #333;
            font-size: 16px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .product-name a:hover {
            color: #0d6efd;
        }

        .product-des {
            color: #6c757d;
            font-size: 14px;
            margin-top: 5px;
        }

        .cart-quantity-form .input-group {
            max-width: 150px;
        }

        .total-amount {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .total-amount .left .coupon {
            margin-bottom: 20px;
        }

        .total-amount .left .coupon input {
            width: 100%;
            height: 50px;
            border: 1px solid #eee;
            padding: 0 20px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .total-amount .right ul {
            list-style: none;
            padding: 0;
        }

        .total-amount .right ul li {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .total-amount .right ul li.last {
            font-weight: 700;
            font-size: 18px;
            border-bottom: none;
            color: #0d6efd;
        }

        .total-amount .button {
            margin-top: 20px;
        }

        .total-amount .button .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-alt {
            background: #6c757d !important;
        }

        .empty-cart {
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 768px) {
            .cart-list-title {
                display: none;
            }

            .cart-single-list .col-12 {
                text-align: center;
                margin-bottom: 10px;
            }
        }
    </style>
</x-front-layout>