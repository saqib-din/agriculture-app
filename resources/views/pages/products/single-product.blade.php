@extends('layouts.landing')

@section('content')
    <!-- Page-title -->
    <div class="page-title page-portfolio-details">
        <div class="rellax" data-rellax-speed="5">
            <img src="{{ asset('assets/images/page-title/shop-detail.jpg') }}" alt="">
        </div>
        <div class="content-wrap">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content center">
                            <p class="sub-title">Buy Health Foods At Our Store</p>
                            <h1 class="title">products detail</h1>
                            <div class="icon-img">
                                <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt="">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ url('/') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="{{ url('products') }}">Products</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="img-item item-2">
            <img src="{{ asset('assets/images/item/grass-6.png') }}" alt="">
        </div>
    </div>

    <!-- Success Message Box (Same as products listing page) -->
    <div id="msg" class="success-message-box" style="display: none;">
        <div class="success-content">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div>
                <strong>Request Sent Successfully!</strong>
                <p>Thank you for contacting us. Our team will review your request and respond within 24 hours via email.</p>
            </div>
        </div>
    </div>

    <style>
        .success-message-box {
            position: fixed;
            top: 20px;
            right: -400px;
            max-width: 450px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #fff;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-left: 5px solid #28a745;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .success-content {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #ffffff;
        }

        .success-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 50%;
            min-width: 50px;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .success-icon svg {
            color: #28a745;
            stroke: #28a745;
        }

        .success-content strong {
            font-size: 18px;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .success-content p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
        }

        @keyframes slideInRight {
            0% {
                right: -400px;
                opacity: 0;
            }

            100% {
                right: 20px;
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            0% {
                right: 20px;
                opacity: 1;
            }

            100% {
                right: -400px;
                opacity: 0;
            }
        }
    </style>

    <!-- Main-content -->
    <div class="main-content page-shop-detail pt-0">
        <!-- Section product detail -->
        <section class="s-product-detail section-image-zoom zoom-active">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-md-6">
                        <div class="thumbs-slider sticky-top">
                            <div class="swiper-container tf-product-media-main">
                                <div class="swiper-wrapper">
                                    @if ($product->images->count())
                                        @foreach ($product->images as $image)
                                            <div class="swiper-slide">
                                                <div class="image item">
                                                    <img src="{{ asset('storage/' . $image->image) }}"
                                                        data-src="{{ asset('storage/' . $image->image) }}"
                                                        data-zoom="{{ asset('storage/' . $image->image) }}" alt=""
                                                        class="lazyload tf-image-zoom">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div class="swiper-slide">
                                                <div class="image item">
                                                    <img src="{{ asset('assets/images/section/shop-detail-' . $i . '.jpg') }}"
                                                        data-src="{{ asset('assets/images/section/shop-detail-' . $i . '.jpg') }}"
                                                        data-zoom="{{ asset('assets/images/section/shop-detail-' . $i . '.jpg') }}"
                                                        alt="" class="lazyload tf-image-zoom">
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>

                            <div class="swiper-container tf-product-media-thumbs" data-direction="horizontal">
                                <div class="swiper-wrapper">
                                    @if ($product->images->count())
                                        @foreach ($product->images as $image)
                                            <div class="swiper-slide">
                                                <div class="image item">
                                                    <img src="{{ asset('storage/' . $image->image) }}"
                                                        data-src="{{ asset('storage/' . $image->image) }}" alt=""
                                                        class="lazyload">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div class="swiper-slide">
                                                <div class="image item">
                                                    <img src="{{ asset('assets/images/section/shop-detail-' . $i . '.jpg') }}"
                                                        data-src="{{ asset('assets/images/section/shop-detail-' . $i . '.jpg') }}"
                                                        alt="" class="lazyload">
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="tf-zoom-main"></div>
                        <div class="content-inner">
                            <h3 class="fw-6 name font-worksans title">{{ $product->name }}</h3>
                            <div class="price-wrap price-left">
                                <span class="price-2">
                                    @if ($product->price)
                                        PKR {{ number_format($product->price, 2) }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <p class="sub font-nunito">{{ $product->brief_details }}</p>
                            <ul class="notice-list">
                                <li>
                                    <svg id="Layer_1" height="24" viewBox="0 0 512 512" width="24"
                                        xmlns="http://www.w3.org/2000/svg" data-name="Layer 1">
                                        <path
                                            d="m441.667 118.253-192-85.333a10.687 10.687 0 0 0 -8.667 0l-192 85.333a10.669 10.669 0 0 0 -6.333 9.747v234.667a10.669 10.669 0 0 0 6.333 9.747l192 85.333a10.673 10.673 0 0 0 8.667 0l192-85.333a10.669 10.669 0 0 0 6.333-9.747v-234.667a10.669 10.669 0 0 0 -6.333-9.747z"
                                            fill="#ff9500" />
                                        <path
                                            d="m249.667 457.747 192-85.333a10.669 10.669 0 0 0 6.333-9.747v-234.667a10.669 10.669 0 0 0 -6.333-9.747l-192-85.333a10.687 10.687 0 0 0 -4.334-.92v426.667a10.7 10.7 0 0 0 4.334-.92z"
                                            fill="#fbab01" />
                                        <path
                                            d="m245.333 213.333 201.65-89.622a10.572 10.572 0 0 0 -5.316-5.459l-192-85.333a10.687 10.687 0 0 0 -8.667 0l-192 85.334a10.572 10.572 0 0 0 -5.316 5.459z"
                                            fill="#fac100" />
                                        <path d="m156.467 173.837 205.133-91.17-26.265-11.673-205.133 91.17z"
                                            fill="#fbab01" />
                                        <circle cx="373.333" cy="362.667" fill="#00cf66" r="96" />
                                        <path
                                            d="m389.333 437.333a90.608 90.608 0 0 1 -56.1-161.807 95.949 95.949 0 1 0 127.241 127.238 90.434 90.434 0 0 1 -71.141 34.569z"
                                            fill="#00b157" />
                                        <path
                                            d="m362.667 405.333a10.632 10.632 0 0 1 -7.542-3.125l-26.667-26.667a10.666 10.666 0 0 1 15.083-15.083l19.125 19.122 45.792-45.789a10.666 10.666 0 1 1 15.083 15.083l-53.333 53.333a10.632 10.632 0 0 1 -7.541 3.126z"
                                            fill="#eaeff0" />
                                    </svg>
                                    <p>
                                        @if (!$product->quantity || $product->quantity == 0)
                                            Out of stock
                                        @elseif($product->quantity == 1)
                                            Available
                                        @else
                                            {{ $product->quantity }} in stock
                                        @endif
                                    </p>
                                </li>
                            </ul>
                            <div class="wrap-quantity">
                                <button type="button" class="tf-btn btn-add-cart" data-bs-toggle="modal"
                                    data-bs-target="#quoteModal" id="singleProductQuoteBtn"
                                    data-product-id="{{ $product->id }}">
                                    <span class="text-style">Request A Quote</span>
                                    <span class="icon">
                                        <i class="fa-solid fa-file-lines"></i>
                                    </span>
                                </button>
                            </div>
                            <ul class="more-infor">
                                <li>
                                    <p>SKU: {{ $product->sku }}</p>
                                </li>
                                <li>
                                    <p>Brand: {{ $product->brand }}</p>
                                </li>
                                <li>
                                    <p>Modal: {{ $product->model }}</p>
                                </li>
                                <li>
                                    <p>
                                        Category:
                                        <a href="#">
                                            {{ $product->category?->name ?? 'Jam & Jelly' }}
                                        </a>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section tab -->
        <section class="s-tab">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wg-tabs style-2">
                            <div class="flex justify-center">
                                <ul class="menu-tab">
                                    <li class="item active"><a href="javascript:void(0)" class="btn-tab">Description</a>
                                    </li>
                                    <li class="item"><a href="javascript:void(0)" class="btn-tab">Additional
                                            information</a></li>
                                </ul>
                            </div>
                            <div class="widget-content-tab">
                                <div class="widget-content-inner active">
                                    {{-- <p class="text-1">{{ $product->brief_details }}</p> --}}
                                    <p class="text-2">{{ $product->description }}</p>
                                </div>
                                <div class="widget-content-inner">
                                    <div class="table-infor">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Specifications Name</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($product->specifications && $product->specifications->count() > 0)
                                                    @foreach ($product->specifications as $specification)
                                                        <tr>

                                                            <th>{{ $specification->name }}</th>
                                                            <td>
                                                                <p>{{ $specification->value }}</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="2" class="text-center text-muted">
                                                            <i class="ti ti-info-circle me-2"></i>
                                                            No specifications available for this product.
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Quotation Modal -->
    <div class="modal modalCentered fade modal-log" id="quoteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>
                <div class="modal-log-wrap list-file-delete">
                    <div class="box-title">
                        <h2 class="title fw-bold">Quotation Request</h2>
                        <p class="fw-normal font-nunito h6 fs-18 text-main">
                            Request a quote for this product
                        </p>
                    </div>
                    <form id="quoteRequestForm" class="form-log">
                        @csrf
                        <input type="hidden" name="single_product_id" id="singleProductId"
                            value="{{ $product->id }}">

                        <div class="form-content">
                            <!-- Row 1: Name and Email -->
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <label for="customer_name" class="text-uppercase">Name *</label>
                                        <input type="text" name="customer_name" id="customer_name"
                                            placeholder="Enter Name" required>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <label for="customer_email" class="text-uppercase">Email *</label>
                                        <input type="email" name="customer_email" id="customer_email"
                                            placeholder="Enter Email" required>
                                    </fieldset>
                                </div>
                            </div>

                            <!-- Row 2: Phone and Quantity -->
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <label for="customer_phone" class="text-uppercase">Phone</label>
                                        <input type="tel" name="customer_phone" id="customer_phone"
                                            placeholder="Enter Phone Number">
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <label for="total_quantity" class="text-uppercase">Quantity</label>
                                        <input type="number" name="total_quantity" id="total_quantity"
                                            placeholder="Enter quantity">
                                    </fieldset>
                                </div>
                            </div>

                            <!-- Row 3: Message -->
                            <div class="row">
                                <div class="col-12">
                                    <fieldset>
                                        <label for="customer_message" class="text-uppercase">Message</label>
                                        <textarea name="customer_message" id="customer_message" rows="4">Hello,

I would like to request a quotation for the selected product(s).
Please provide pricing, availability, and any additional details at your earliest convenience.

Thank you.</textarea>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="button-submit">
                            <button type="submit" class="tf-btn-nor w-100">
                                <span class="submit-text">Send Request</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quoteForm = document.getElementById('quoteRequestForm');
            const singleProductId = document.getElementById('singleProductId').value;

            // Handle form submission for single product
            quoteForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const submitText = submitBtn.querySelector('.submit-text');
                const spinner = submitBtn.querySelector('.spinner-border');

                // Disable button and show spinner
                submitBtn.disabled = true;
                submitText.classList.add('d-none');
                spinner.classList.remove('d-none');

                const formData = new FormData(this);

                // Add single product ID
                formData.append('products[]', singleProductId);

                // Add quantity
                const quantity = document.getElementById('total_quantity').value || 1;
                formData.append('quantities[]', quantity);

                fetch('/quote-request', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Reset button state
                        submitBtn.disabled = false;
                        submitText.classList.remove('d-none');
                        spinner.classList.add('d-none');

                        if (data.success) {
                            // Show left-side slide-in message (same as products listing page)
                            showSuccessMessage();

                            // Reset form
                            quoteForm.reset();
                            document.getElementById('total_quantity').value = 1;

                            // Restore default message
                            document.getElementById('customer_message').value = `Hello,

I would like to request a quotation for the selected product(s).
Please provide pricing, availability, and any additional details at your earliest convenience.

Thank you.`;

                            // Close modal
                            const modalElement = document.getElementById('quoteModal');
                            const modal = bootstrap.Modal.getInstance(modalElement);
                            if (modal) {
                                modal.hide();
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message ||
                                    'Failed to submit quote request. Please try again.',
                                confirmButtonColor: '#235130'
                            });
                        }
                    })
                    .catch(error => {
                        // Reset button state
                        submitBtn.disabled = false;
                        submitText.classList.remove('d-none');
                        spinner.classList.add('d-none');

                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred. Please try again later.',
                            confirmButtonColor: '#235130'
                        });
                    });
            });
        });

        // Success message function (same as products listing page)
        function showSuccessMessage() {
            const msgBox = document.getElementById('msg');

            // Reset position and display
            msgBox.style.display = 'flex';
            msgBox.style.right = '-400px'; // start off-screen
            msgBox.style.animation = 'slideInRight 0.5s forwards';

            // Auto hide after 4 seconds
            setTimeout(() => {
                msgBox.style.animation = 'slideOutRight 0.5s forwards';
                setTimeout(() => {
                    msgBox.style.display = 'none';
                }, 500);
            }, 4000);
        }
    </script>
@endsection
