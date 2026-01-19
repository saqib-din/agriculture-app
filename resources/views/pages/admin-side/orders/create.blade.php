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
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Orders</a></li>
                                <li class="breadcrumb-item">Create</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Create New Order</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <form action="{{ route('admin.orders.store') }}" method="POST" id="orderForm">
                @csrf
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
                                        <label class="form-label">Select Client <span class="text-danger">*</span></label>
                                        <select name="client_id" id="clientSelect" class="form-select" required>
                                            <option value="">Choose a client...</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}" data-email="{{ $client->email }}"
                                                    data-phone="{{ $client->phone }}" data-company="{{ $client->company }}"
                                                    data-address="{{ $client->address }}">
                                                    {{ $client->name }} - {{ $client->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Client Details Display -->
                                    <div class="col-12" id="clientDetails" style="display: none;">
                                        <div class="alert alert-info">
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <strong>Email:</strong> <span id="clientEmail"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Phone:</strong> <span id="clientPhone"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Company:</strong> <span id="clientCompany"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Address:</strong> <span id="clientAddress"></span>
                                                </div>
                                            </div>
                                        </div>
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
                                <button type="button" class="btn btn-sm btn-primary" id="addProductBtn">
                                    <i class="ti ti-plus me-1"></i> Add Product
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="productsTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%;">Product</th>
                                                <th style="width: 15%;" class="text-center">Quantity</th>
                                                <th style="width: 20%;" class="text-end">Price</th>
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
                                                    <strong>Tax (17%):</strong>
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
                                                            value="0" min="0" step="0.01">
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
                                <textarea name="notes" class="form-control" rows="3" placeholder="Enter any additional notes..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-x me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-check me-1"></i> Create Order
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clientSelect = document.getElementById('clientSelect');
            const clientDetails = document.getElementById('clientDetails');
            const addProductBtn = document.getElementById('addProductBtn');
            const productsTableBody = document.getElementById('productsTableBody');
            const discountInput = document.getElementById('discountInput');

            const products = @json($products);
            let productCount = 0;

            // Client selection handler
            clientSelect.addEventListener('change', function() {
                if (this.value) {
                    const option = this.options[this.selectedIndex];
                    document.getElementById('clientEmail').textContent = option.dataset.email || 'N/A';
                    document.getElementById('clientPhone').textContent = option.dataset.phone || 'N/A';
                    document.getElementById('clientCompany').textContent = option.dataset.company || 'N/A';
                    document.getElementById('clientAddress').textContent = option.dataset.address || 'N/A';
                    clientDetails.style.display = 'block';
                } else {
                    clientDetails.style.display = 'none';
                }
            });

            // Add product row
            addProductBtn.addEventListener('click', function() {
                const row = document.createElement('tr');
                const rowId = 'product-row-' + productCount++;

                row.id = rowId;
                row.innerHTML = `
            <td>
                <select class="form-select product-select" name="products[${rowId}][id]" required onchange="updateProductPrice(this)">
                    <option value="">Select Product...</option>
                    ${products.map(p => `
                                <option value="${p.id}" data-price="${p.price}" data-sku="${p.sku}">
                                    ${p.name} - ${p.sku} (PKR ${parseFloat(p.price).toFixed(2)})
                                </option>
                            `).join('')}
                </select>
            </td>
            <td>
                <input type="number" class="form-control text-center quantity-input" 
                       name="products[${rowId}][quantity]" 
                       value="1" min="1" required onchange="calculateRowTotal(this)">
            </td>
            <td>
                <input type="number" class="form-control text-end price-input" 
                       name="products[${rowId}][price]" 
                       value="0.00" step="0.01" readonly>
            </td>
            <td class="text-end">
                <strong class="row-subtotal">PKR 0.00</strong>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-icon btn-link-danger" onclick="removeProductRow('${rowId}')">
                    <i class="ti ti-trash"></i>
                </button>
            </td>
        `;

                productsTableBody.appendChild(row);
            });

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
                document.getElementById(rowId).remove();
                calculateGrandTotal();
            };

            // Calculate grand total
            function calculateGrandTotal() {
                let subtotal = 0;

                document.querySelectorAll('.row-subtotal').forEach(el => {
                    const amount = parseFloat(el.textContent.replace('PKR ', '').replace(',', '')) || 0;
                    subtotal += amount;
                });

                const discount = parseFloat(discountInput.value) || 0;
                const taxableAmount = subtotal - discount;
                const tax = taxableAmount * 0.17;
                const grandTotal = subtotal + tax - discount;

                document.getElementById('subtotalDisplay').textContent = `PKR ${subtotal.toFixed(2)}`;
                document.getElementById('taxDisplay').textContent = `PKR ${tax.toFixed(2)}`;
                document.getElementById('discountDisplay').textContent = `PKR ${discount.toFixed(2)}`;
                document.getElementById('grandTotalDisplay').textContent = `PKR ${grandTotal.toFixed(2)}`;
            }

            discountInput.addEventListener('input', calculateGrandTotal);
        });
    </script>

    <style>
        .product-select {
            font-size: 0.875rem;
        }
    </style>
@endsection
