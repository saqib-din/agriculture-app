@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/products') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Products</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Products List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Product list</h5>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-outline-secondary me-2 d-flex" data-bs-toggle="modal"
                                        data-bs-target="#bulkModal">
                                        <i class="ti ti-edit me-1"></i> Bulk Change
                                    </button>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                        Add Product
                                    </a>
                                    {{-- <i class="ti ti-plus me-1"></i> --}}
                                </div>
                            </div>
                        </div>

                        {{-- Bulk Actions Modal --}}
                        <div class="modal fade" id="bulkModal" tabindex="-1">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Products Control</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="bulkForm">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Quantity Display</label>
                                                <select class="form-select" name="quantity_display">
                                                    <option value="">No Change</option>
                                                    <option value="hide">Hide Quantity</option>
                                                    <option value="availability">Show Availability Only</option>
                                                    <option value="full">Show Full Quantity</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Price Display</label>
                                                <select class="form-select" name="price_display">
                                                    <option value="">No Change</option>
                                                    <option value="hide">Hide Price</option>
                                                    <option value="price">Show Price</option>
                                                    <option value="call">Call for Price</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="">No Change</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>

                                            <div class="alert alert-info mb-0">
                                                <i class="ti ti-info-circle me-2"></i>
                                                <small>Select products below and apply changes in bulk</small>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" id="applyBulk">
                                            Apply Changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th width="40">
                                                <input type="checkbox" class="form-check-input" id="selectAll">
                                            </th>
                                            <th>Product / Brand</th>
                                            <th>SKU / Model</th>
                                            <th width="180">Quantity</th>
                                            <th width="180">Price</th>
                                            <th class="text-center" width="100">Status</th>
                                            <th class="text-end" width="120">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr data-product-id="{{ $product->id }}">
                                                <td>
                                                    <input type="checkbox" class="product-checkbox form-check-input"
                                                        value="{{ $product->id }}">
                                                </td>

                                                {{-- Product Info --}}
                                                <td>
                                                    <h6 class="mb-0">{{ $product->name }}</h6>
                                                    <small class="text-muted">{{ $product->brand ?? 'N/A' }}</small>
                                                </td>

                                                {{-- SKU / Model --}}
                                                <td>
                                                    <span class="badge bg-light-secondary">{{ $product->sku }}</span>
                                                    <div><small class="text-muted">{{ $product->model ?? 'N/A' }}</small>
                                                    </div>
                                                </td>

                                                {{-- QUANTITY with Dropdown --}}
                                                <td>
                                                    <div class="dropdown-container">
                                                        <button class="status-btn quantity-btn" data-type="quantity"
                                                            data-id="{{ $product->id }}"
                                                            data-current="{{ $product->quantity_display ?? 'full' }}">
                                                            @if ($product->quantity_display === 'hide')
                                                                <i class="ti ti-lock text-muted"></i> Hidden
                                                            @elseif ($product->quantity_display === 'availability')
                                                                <i class="ti ti-check text-success"></i>
                                                                {{ $product->quantity > 0 ? 'Available' : 'Out of stock' }}
                                                            @else
                                                                <i class="ti ti-package"></i>
                                                                {{ $product->quantity > 0 ? $product->quantity . ' in stock' : 'Out of stock' }}
                                                            @endif
                                                            <i class="ti ti-chevron-down ms-1"></i>
                                                        </button>

                                                        <div class="dropdown-menu-custom">
                                                            <div class="dropdown-item-custom" data-value="hide">
                                                                <i class="ti ti-lock"></i> Hide Quantity
                                                            </div>
                                                            <div class="dropdown-item-custom" data-value="availability">
                                                                <i class="ti ti-check"></i> Show Availability
                                                            </div>
                                                            <div class="dropdown-item-custom" data-value="full">
                                                                <i class="ti ti-package"></i> Show Full Quantity
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- PRICE with Dropdown --}}
                                                <td>
                                                    <div class="dropdown-container">
                                                        <button class="status-btn price-btn" data-type="price"
                                                            data-id="{{ $product->id }}"
                                                            data-current="{{ $product->price_display ?? 'price' }}">
                                                            @if ($product->price_display === 'hide')
                                                                <i class="ti ti-lock text-muted"></i> Hidden
                                                            @elseif ($product->price_display === 'call')
                                                                <i class="ti ti-phone text-primary"></i> Call for Price
                                                            @else
                                                                <i class="ti ti-currency-rupee"></i> PKR
                                                                {{ number_format($product->price ?? 0) }}
                                                            @endif
                                                            <i class="ti ti-chevron-down ms-1"></i>
                                                        </button>

                                                        <div class="dropdown-menu-custom">
                                                            <div class="dropdown-item-custom" data-value="hide">
                                                                <i class="ti ti-lock"></i> Hide Price
                                                            </div>
                                                            <div class="dropdown-item-custom" data-value="price">
                                                                <i class="ti ti-currency-rupee"></i> Show Price
                                                            </div>
                                                            <div class="dropdown-item-custom" data-value="call">
                                                                <i class="ti ti-phone"></i> Call for Price
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- STATUS Toggle --}}
                                                <td class="text-center">
                                                    <span
                                                        class="badge toggle-status {{ $product->status ? 'bg-light-success' : 'bg-light-danger' }}"
                                                        data-id="{{ $product->id }}" style="cursor: pointer;">
                                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>

                                                {{-- ACTIONS --}}
                                                <td class="text-end">
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="ti ti-edit f-18"></i>
                                                    </a>

                                                    <a href="#" class="avtar avtar-xs btn-link-danger bs-pass-para"
                                                        data-id="{{ $product->id }}" data-bs-toggle="tooltip"
                                                        title="Delete">
                                                        <i class="ti ti-trash f-18"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $product->id }}"
                                                        action="{{ route('admin.products.destroy', $product->id) }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">
                                                    <i class="ti ti-package-off" style="font-size: 3rem;"></i>
                                                    <p class="mb-0 mt-2">No products found</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STYLES --}}
    <style>
        /* Dropdown Container */
        .dropdown-container {
            position: relative;
            display: inline-block;
        }

        /* Status Button */
        .status-btn {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 13px;
            color: #495057;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            white-space: nowrap;
            width: 100%;
            justify-content: space-between;
        }

        .status-btn:hover {
            background: #e9ecef;
            border-color: #adb5bd;
        }

        .status-btn i:not(.ti-chevron-down) {
            font-size: 14px;
        }

        /* Dropdown Menu */
        .dropdown-menu-custom {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            min-width: 180px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1050;
            padding: 6px;
            display: none;
            animation: slideDown 0.2s ease;
        }

        .dropdown-menu-custom.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Dropdown Items */
        .dropdown-item-custom {
            padding: 8px 12px;
            font-size: 13px;
            color: #495057;
            cursor: pointer;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.15s ease;
        }

        .dropdown-item-custom:hover {
            background: #f1f5f9;
            color: #000;
        }

        .dropdown-item-custom i {
            font-size: 14px;
            width: 16px;
        }

        /* Status Badge */
        .toggle-status {
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .toggle-status:hover {
            opacity: 0.85;
            transform: scale(1.05);
        }

        /* Table Hover Effect */
        /* .table-hover tbody tr:hover {
                                background-color: #f8f9fa;
                            } */

        /* Checkbox Styling */
        .form-check-input {
            cursor: pointer;
            width: 18px;
            height: 18px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .status-btn {
                font-size: 12px;
                padding: 6px 10px;
            }

            .dropdown-menu-custom {
                min-width: 160px;
            }
        }
    </style>

    {{-- SCRIPTS --}}
    <script>
        // Select All Checkbox
        document.getElementById('selectAll').addEventListener('change', function() {
            document.querySelectorAll('.product-checkbox')
                .forEach(cb => cb.checked = this.checked);
        });

        // Bulk Update
        document.getElementById('applyBulk').addEventListener('click', function() {
            let ids = [];
            document.querySelectorAll('.product-checkbox:checked')
                .forEach(cb => ids.push(cb.value));

            if (ids.length === 0) {
                alert('Please select at least one product');
                return;
            }

            let formData = new FormData(document.getElementById('bulkForm'));
            formData.append('ids', ids);

            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Applying...';

            fetch("{{ route('admin.products.bulk-update') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    location.reload();
                })
                .catch(error => {
                    alert('Error updating products');
                    console.error(error);
                    this.disabled = false;
                    this.innerHTML = '<i class="ti ti-check me-1"></i> Apply Changes';
                });
        });

        // Dropdown Toggle Logic
        document.addEventListener('click', function(e) {
            // Open dropdown
            if (e.target.closest('.status-btn')) {
                e.preventDefault();
                e.stopPropagation();

                let btn = e.target.closest('.status-btn');
                let menu = btn.nextElementSibling;

                // Close all other dropdowns
                document.querySelectorAll('.dropdown-menu-custom').forEach(m => {
                    if (m !== menu) m.classList.remove('show');
                });

                // Toggle current dropdown
                menu.classList.toggle('show');
                return;
            }

            // Select dropdown item
            if (e.target.closest('.dropdown-item-custom')) {
                let item = e.target.closest('.dropdown-item-custom');
                let menu = item.closest('.dropdown-menu-custom');
                let btn = menu.previousElementSibling;

                let id = btn.dataset.id;
                let type = btn.dataset.type;
                let value = item.dataset.value;

                // Update UI immediately
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

                let url = type === 'quantity' ?
                    `/admin/products/quantity-display/${id}` :
                    `/admin/products/price-display/${id}`;

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            type: value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        location.reload();
                    })
                    .catch(error => {
                        alert('Error updating display');
                        console.error(error);
                        btn.disabled = false;
                    });

                menu.classList.remove('show');
            }

            // Close dropdowns on outside click
            if (!e.target.closest('.dropdown-container')) {
                document.querySelectorAll('.dropdown-menu-custom').forEach(m => m.classList.remove('show'));
            }
        });

        // Toggle Status
        document.querySelectorAll('.toggle-status').forEach(badge => {
            badge.addEventListener('click', function() {
                let id = this.dataset.id;
                const currentBadge = this;

                // Show spinner while processing
                currentBadge.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

                fetch(`/admin/products/status/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Update badge text and color
                        currentBadge.textContent = data.status ? 'Active' : 'Inactive';
                        currentBadge.classList.remove('bg-light-success', 'bg-light-danger');
                        currentBadge.classList.add(data.status ? 'bg-light-success' :
                            'bg-light-danger');

                        // Show success message
                        showSuccessMessage(`Status updated to ${data.status ? 'Active' : 'Inactive'}`);
                    })
                    .catch(error => {
                        alert('Error updating status');
                        console.error(error);
                    });
            });
        });

        // Function to show temporary success message
        function showSuccessMessage(message) {
            let existingMsg = document.querySelector('.ajax-success-msg');
            if (existingMsg) existingMsg.remove();

            const msgBox = document.createElement('div');
            msgBox.className = 'alert alert-success ajax-success-msg';
            msgBox.style.position = 'fixed';
            msgBox.style.bottom = '20px';
            msgBox.style.right = '20px';
            msgBox.style.zIndex = '9999';
            msgBox.style.minWidth = '250px';
            msgBox.style.textAlign = 'center';
            msgBox.style.padding = '10px 20px';
            msgBox.style.borderRadius = '8px';
            msgBox.style.boxShadow = '0 4px 10px rgba(0,0,0,0.2)';
            msgBox.textContent = message;

            document.body.appendChild(msgBox);

            setTimeout(() => {
                msgBox.remove();
            }, 3000);
        }
    </script>
@endsection
