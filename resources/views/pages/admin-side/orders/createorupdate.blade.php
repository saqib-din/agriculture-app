@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                                <li class="breadcrumb-item">{{ isset($order) ? 'Edit' : 'Create' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">
                                    {{ isset($order) ? 'Edit Order - ' . $order->order_number : 'Create New Order' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <form action="{{ isset($order) ? route('admin.orders.update', $order->id) : route('admin.orders.store') }}"
                method="POST" id="orderForm">
                @csrf
                @if (isset($order))
                    @method('PUT')
                @endif
                <input type="hidden" name="quote_request_id" value="{{ $quoteRequestId ?? '' }}">

                <div class="row">
                    <!-- Client Selection -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Client Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        @if (isset($selectedClientId) && $selectedClientId)
                                            <select class="form-select" disabled>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}"
                                                        {{ $selectedClientId == $client->id ? 'selected' : '' }}>
                                                        {{ $client->name }} - {{ $client->email }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="client_id" value="{{ $selectedClientId }}">
                                        @else
                                            {{-- New Order: admin can select --}}
                                            <label class="form-label">Select Client <span
                                                    class="text-danger">*</span></label>
                                            <select name="client_id" id="clientSelect" class="form-select" required>
                                                <option value="">Choose a client...</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">
                                                        {{ $client->name }} - {{ $client->email }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Selection -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Products</h5>
                                <button type="button" class="btn btn-md btn-primary d-flex" id="addProductBtn">
                                    <i class="ti ti-plus me-1"></i> Add Product
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="productsTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%;">Product <span class="text-danger">*</span></th>
                                                <th style="width: 15%;" class="text-center">Quantity <span
                                                        class="text-danger">*</span></th>
                                                <th style="width: 20%;" class="text-end">Price <span
                                                        class="text-danger">*</span></th>
                                                <th style="width: 20%;" class="text-end">Subtotal</th>
                                                <th style="width: 5%;" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productsTableBody">
                                            <!-- Product rows will be added here -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                                <td class="text-end"><strong id="subtotalDisplay">PKR 0.00</strong></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end">
                                                    <strong>GST (<span
                                                            id="gstPercentage">{{ $gstRate ?? 0 }}</span>%):</strong>
                                                </td>
                                                <td class="text-end"><strong id="taxDisplay">PKR 0.00</strong></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end">
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <strong class="me-2">Discount:</strong>
                                                        <input type="number" name="discount" id="discountInput"
                                                            class="form-control form-control-sm" style="width: 150px;"
                                                            value="{{ isset($order) ? $order->discount : 0 }}"
                                                            min="0" step="0.01">
                                                    </div>
                                                </td>
                                                <td class="text-end"><strong id="discountDisplay">PKR 0.00</strong></td>
                                                <td></td>
                                            </tr>
                                            <tr class="table-active">
                                                <td colspan="3" class="text-end">
                                                    <h5 class="mb-0">Grand Total:</h5>
                                                </td>
                                                <td class="text-end">
                                                    <h5 class="mb-0" id="grandTotalDisplay">PKR 0.00</h5>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Additional Information</h5>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Enter any additional notes...">{{ isset($order) ? $order->notes : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($order) ? 'Update Order' : 'Create Order' }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />

    <style>
        .product-select {
            font-size: 0.875rem;
        }

        /* Select2 Custom Styling */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px;
            border-color: #dee2e6;
        }

        /* .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
                                        line-height: 38px;
                                        padding-left: 12px;
                                    } */

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        /* .select2-container--bootstrap-5.select2-container--focus .select2-selection,
                                    .select2-container--bootstrap-5.select2-container--open .select2-selection {
                                        border-color: #86b7fe;
                                        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
                                    } */

        /* .select2-dropdown {
                                        border-color: #dee2e6;
                                    } */

        .select2-container--bootstrap-5 .select2-results__option {
            padding: 8px 12px;
        }

        /* .select2-container--bootstrap-5 .select2-results__option--highlighted {
                                        background-color: #0d6efd;
                                        color: white;
                                    } */

        .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 6px 12px;
        }


        /* .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field:focus {
                border-color: #86b7fe;
                outline: 0;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
                }  */

        /* Product option styling */
        .product-option-text {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-option-name {
            font-weight: 500;
            color: #212529;
        }

        .product-option-sku {
            font-size: 0.85em;
            color: #6c757d;
            margin-left: 8px;
            /* display: none; */
        }

        .product-option-price {
            font-size: 0.9em;
            color: #198754;
            font-weight: 600;
            margin-left: auto;
            padding-left: 12px;
            display: none;

        }

        /* Animation for row addition */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #productsTableBody tr {
            animation: slideIn 0.3s ease-out;
        }

        /* Hover effect for delete button */
        .btn-link-danger:hover {
            background-color: #fff5f5;
            border-radius: 4px;
        }
    </style>
@endpush

@push('scripts')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clientSelect = document.getElementById('clientSelect');
            const addProductBtn = document.getElementById('addProductBtn');
            const productsTableBody = document.getElementById('productsTableBody');
            const discountInput = document.getElementById('discountInput');

            const products = @json($products);
            const quoteProducts = @json($quoteProducts ?? []);

            @php
                $orderProductsData = [];
                if (isset($order)) {
                    $orderProductsData = $order->products
                        ->map(function ($product) {
                            return [
                                'id' => $product->id,
                                'quantity' => $product->pivot->quantity,
                                'price' => $product->pivot->price,
                            ];
                        })
                        ->toArray();
                }
            @endphp

            const orderProducts = @json($orderProductsData);

            const gstRate = {{ $gstRate ?? 0 }};
            let productCount = 0;

            // Initialize Select2 for client select if exists
            if (clientSelect) {
                $(clientSelect).select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Choose a client...',
                    allowClear: true,
                    width: '100%'
                });
            }

            // Pre-populate products from quote if available
            if (quoteProducts.length > 0) {
                quoteProducts.forEach(product => {
                    addProductRow(product.id, product.pivot.quantity, product.price);
                });
            }
            // Pre-populate products from order if editing
            else if (orderProducts.length > 0) {
                orderProducts.forEach(product => {
                    addProductRow(product.id, product.quantity, product.price);
                });
            }

            // Add product row
            addProductBtn.addEventListener('click', function() {
                addProductRow();
            });

            function addProductRow(selectedProductId = null, selectedQuantity = 1, selectedPrice = 0) {
                const row = document.createElement('tr');
                const rowId = 'product-row-' + productCount++;

                row.id = rowId;
                row.innerHTML = `
                    <td>
                        <select class="form-select product-select"
                            name="products[${rowId}][id]"
                            id="product-select-${rowId}"
                            required>
                            <option value="">Select Product...</option>
                            ${products.map(p => `
                                                                <option value="${p.id}"
                                                                    data-price="${p.price}"
                                                                    data-sku="${p.sku}"
                                                                    ${selectedProductId == p.id ? 'selected' : ''}>
                                                                    ${p.name} (${p.sku}) - PKR ${parseFloat(p.price).toFixed(2)}
                                                                </option>
                                                            `).join('')}
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control text-center quantity-input" 
                               name="products[${rowId}][quantity]" 
                               value="${selectedQuantity}" min="1" required>
                    </td>
                    <td>
                        <input type="number" class="form-control text-end price-input" 
                               name="products[${rowId}][price]" 
                               value="${parseFloat(selectedPrice).toFixed(2)}" step="0.01" required>
                    </td>
                    <td class="text-end">
                        <strong class="row-subtotal">PKR ${(selectedQuantity * selectedPrice).toFixed(2)}</strong>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-link-danger" onclick="removeProductRow('${rowId}')">
                            <i class="ti ti-trash"></i>
                        </button>
                    </td>
                `;

                productsTableBody.appendChild(row);

                // Initialize Select2 for the new product select
                const newSelect = $(`#product-select-${rowId}`);
                newSelect.select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Select Product...',
                    allowClear: true,
                    width: '100%',
                    templateResult: formatProductOption,
                    templateSelection: formatProductSelection
                });

                // Event handler for product selection change
                newSelect.on('change', function() {
                    updateProductPrice(this);
                });

                // Event handlers for quantity and price changes
                row.querySelector('.quantity-input').addEventListener('input', function() {
                    calculateRowTotal(this);
                });

                row.querySelector('.price-input').addEventListener('input', function() {
                    calculateRowTotal(this);
                });

                calculateGrandTotal();
            }

            // Format product option in dropdown with better styling
            function formatProductOption(product) {
                if (!product.id) {
                    return product.text;
                }

                const $product = $(product.element);
                const price = $product.data('price');
                const sku = $product.data('sku');

                const $container = $('<div class="product-option-text"></div>');
                const $name = $('<span class="product-option-name"></span>').text(product.text.split(' (')[0]);
                const $sku = $('<span class="product-option-sku"></span>').text(`SKU: ${sku}`);
                const $price = $('<span class="product-option-price"></span>').text(
                    `PKR ${parseFloat(price).toFixed(2)}`);

                $container.append($name, $sku, $price);

                return $container;
            }

            // Format selected product
            function formatProductSelection(product) {
                if (!product.id) {
                    return product.text;
                }

                const $product = $(product.element);
                const sku = $product.data('sku');

                return `${product.text.split(' (')[0]} (${sku})`;
            }

            // Update product price when selected
            window.updateProductPrice = function(select) {
                const row = select.closest('tr');
                const option = select.options[select.selectedIndex];
                const price = option.dataset.price || 0;

                row.querySelector('.price-input').value = parseFloat(price).toFixed(2);
                calculateRowTotal(row.querySelector('.quantity-input'));
            };

            // Calculate row total
            window.calculateRowTotal = function(input) {
                const row = input.closest('tr');
                const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
                const price = parseFloat(row.querySelector('.price-input').value) || 0;
                const subtotal = quantity * price;

                row.querySelector('.row-subtotal').textContent = `PKR ${subtotal.toFixed(2)}`;
                calculateGrandTotal();
            };

            // Remove product row
            window.removeProductRow = function(rowId) {
                const row = document.getElementById(rowId);

                // Destroy Select2 before removing the row
                $(row).find('.product-select').select2('destroy');

                row.remove();
                calculateGrandTotal();
            };

            // Calculate grand total with GST
            function calculateGrandTotal() {
                let subtotal = 0;

                // Calculate subtotal from all products
                document.querySelectorAll('.row-subtotal').forEach(el => {
                    const amount = parseFloat(el.textContent.replace('PKR ', '').replace(',', '')) || 0;
                    subtotal += amount;
                });

                // Get discount
                const discount = parseFloat(discountInput.value) || 0;

                // Calculate GST on subtotal (before discount)
                const gstAmount = subtotal * (gstRate / 100);

                // Calculate grand total: Subtotal + GST - Discount
                const grandTotal = subtotal + gstAmount - discount;

                // Update displays
                document.getElementById('subtotalDisplay').textContent = `PKR ${subtotal.toFixed(2)}`;
                document.getElementById('taxDisplay').textContent = `PKR ${gstAmount.toFixed(2)}`;
                document.getElementById('discountDisplay').textContent = `PKR ${discount.toFixed(2)}`;
                document.getElementById('grandTotalDisplay').textContent = `PKR ${grandTotal.toFixed(2)}`;
            }

            discountInput.addEventListener('input', calculateGrandTotal);
        });
    </script>
@endpush
