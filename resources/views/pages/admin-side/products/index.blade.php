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
                                <table class="table table-hover mb-0" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th width="40" data-sortable="false">
                                                <input type="checkbox" class="form-check-input" id="selectAll">
                                            </th>
                                            <th>Product / Brand</th>
                                            <th>SKU / Model</th>
                                            <th width="180">Quantity</th>
                                            <th width="180">Price</th>
                                            <th class="text-center" width="100">Status</th>
                                            <th class="text-end" width="120" data-sortable="false">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr data-product-id="{{ $product->id }}">
                                                <td>
                                                    <input type="checkbox" class="product-checkbox form-check-input"
                                                        value="{{ $product->id }}">
                                                </td>

                                                <td>
                                                    <h6 class="mb-0">{{ $product->name }}</h6>
                                                    <small class="text-muted">{{ $product->brand ?? 'N/A' }}</small>
                                                </td>

                                                <td>
                                                    <span class="badge bg-light-secondary">{{ $product->sku }}</span>
                                                    <div><small class="text-muted">{{ $product->model ?? 'N/A' }}</small>
                                                    </div>
                                                </td>

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

                                                <td>
                                                    <div class="dropdown-container">
                                                        <button class="status-btn price-btn" data-type="price"
                                                            data-id="{{ $product->id }}"
                                                            data-current="{{ $product->price_display ?? 'price' }}">
                                                            @if ($product->price_display === 'hide')
                                                                <i class="ti ti-lock text-muted"></i> Hidden
                                                            @elseif ($product->price_display === 'call')
                                                                <i class="ti ti-mail text-primary"></i> Email for Price
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
                                                                <i class="ti ti-mail"></i> Email for Price
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <span
                                                        class="badge toggle-status {{ $product->status ? 'bg-light-success' : 'bg-light-danger' }}"
                                                        data-id="{{ $product->id }}" style="cursor: pointer;">
                                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>

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

    <style>
        .dropdown-container {
            position: relative;
            display: inline-block;
        }

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

        .form-check-input {
            cursor: pointer;
            width: 18px;
            height: 18px;
        }

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

    <script>
        let dataTable;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable with proper configuration
            dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
                sortable: true,
                searchable: true,
                fixedHeight: true,
                columns: [{
                        select: 0,
                        sortable: false
                    }, // Checkbox column
                    {
                        select: 6,
                        sortable: false
                    } // Actions column
                ]
            });

            // Wait for DataTable to finish rendering
            setTimeout(initializeCheckboxes, 100);

            // Re-initialize checkboxes after any DataTable update (search, sort, pagination)
            dataTable.on('datatable.update', function() {
                setTimeout(initializeCheckboxes, 50);
            });

            dataTable.on('datatable.sort', function() {
                setTimeout(initializeCheckboxes, 50);
            });

            dataTable.on('datatable.search', function() {
                setTimeout(initializeCheckboxes, 50);
            });
        });

        function initializeCheckboxes() {
            const selectAllCheckbox = document.getElementById('selectAll');

            if (!selectAllCheckbox) return;

            // Remove old event listeners by cloning
            const newSelectAll = selectAllCheckbox.cloneNode(true);
            selectAllCheckbox.parentNode.replaceChild(newSelectAll, selectAllCheckbox);

            // Add fresh event listener
            newSelectAll.addEventListener('change', function() {
                const productCheckboxes = document.querySelectorAll('.product-checkbox');
                productCheckboxes.forEach(cb => {
                    cb.checked = this.checked;
                });
            });

            // Update selectAll state when individual checkboxes change
            document.querySelectorAll('.product-checkbox').forEach(checkbox => {
                // Remove old listeners by cloning
                const newCheckbox = checkbox.cloneNode(true);
                checkbox.parentNode.replaceChild(newCheckbox, checkbox);

                // Add fresh event listener
                newCheckbox.addEventListener('change', function() {
                    updateSelectAllState();
                });
            });

            // Initial state check
            updateSelectAllState();
        }

        function updateSelectAllState() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            const checkedCheckboxes = document.querySelectorAll('.product-checkbox:checked');

            if (!selectAllCheckbox || productCheckboxes.length === 0) return;

            if (checkedCheckboxes.length === 0) {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
            } else if (checkedCheckboxes.length === productCheckboxes.length) {
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;
            } else {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = true;
            }
        }

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
                    this.innerHTML = 'Apply Changes';
                });
        });

        // ----- Dropdown Status / Quantity / Price -----
        document.addEventListener('click', function(e) {

            // Open/close dropdown
            if (e.target.closest('.status-btn')) {
                e.preventDefault();
                e.stopPropagation();
                let btn = e.target.closest('.status-btn');
                let menu = btn.nextElementSibling;
                document.querySelectorAll('.dropdown-menu-custom').forEach(m => {
                    if (m !== menu) m.classList.remove('show');
                });
                menu.classList.toggle('show');
                return;
            }

            // Dropdown item clicked (Quantity/Price)
            if (e.target.closest('.dropdown-item-custom')) {
                let item = e.target.closest('.dropdown-item-custom');
                let menu = item.closest('.dropdown-menu-custom');
                let btn = menu.previousElementSibling;

                let id = btn.dataset.id;
                let type = btn.dataset.type;
                let value = item.dataset.value;

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
                        btn.disabled = false;

                        if (type === 'quantity') {
                            updateQuantityBtn(btn, data);
                        } else {
                            updatePriceBtn(btn, data);
                        }

                        showSuccessMessage(data.message);
                    })
                    .catch(error => {
                        alert('Error updating display');
                        console.error(error);
                        btn.disabled = false;
                    });

                menu.classList.remove('show');
            }

            // Click outside dropdown
            if (!e.target.closest('.dropdown-container')) {
                document.querySelectorAll('.dropdown-menu-custom').forEach(m => m.classList.remove('show'));
            }
        });

        // ----- Toggle Product Status -----
        document.addEventListener('click', function(e) {
            if (e.target.closest('.toggle-status')) {
                const badge = e.target.closest('.toggle-status');
                let id = badge.dataset.id;

                badge.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

                fetch(`/admin/products/status/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        badge.textContent = data.status ? 'Active' : 'Inactive';
                        badge.classList.remove('bg-light-success', 'bg-light-danger');
                        badge.classList.add(data.status ? 'bg-light-success' : 'bg-light-danger');
                        showSuccessMessage(`Status updated to ${data.status ? 'Active' : 'Inactive'}`);
                    })
                    .catch(error => {
                        alert('Error updating status');
                        console.error(error);
                    });
            }
        });

        // ----- Update Quantity Button Display -----
        function updateQuantityBtn(btn, data) {
            if (data.type === 'hide') {
                btn.innerHTML = `<i class="ti ti-lock text-muted"></i> Hidden <i class="ti ti-chevron-down ms-1"></i>`;
            } else if (data.type === 'availability') {
                let qty = data.new_quantity ?? 0;
                btn.innerHTML =
                    `<i class="ti ti-check text-success"></i> ${qty>0?'Available':'Out of stock'} <i class="ti ti-chevron-down ms-1"></i>`;
            } else {
                let qty = data.new_quantity ?? 0;
                btn.innerHTML = `<i class="ti ti-package"></i> ${qty} in stock <i class="ti ti-chevron-down ms-1"></i>`;
            }
        }

        // ----- Update Price Button Display -----
        function updatePriceBtn(btn, data) {
            if (data.type === 'hide') {
                btn.innerHTML = `<i class="ti ti-lock text-muted"></i> Hidden <i class="ti ti-chevron-down ms-1"></i>`;
            } else if (data.type === 'call') {
                btn.innerHTML =
                    `<i class="ti ti-mail text-primary"></i> Email for Price <i class="ti ti-chevron-down ms-1"></i>`;
            } else {
                let price = data.new_price ?? 0;
                btn.innerHTML = `<i class="ti ti-currency-rupee"></i> PKR ${price} <i class="ti ti-chevron-down ms-1"></i>`;
            }
        }

        // ----- Success Message Function -----
        function showSuccessMessage(message) {
            let existingMsg = document.querySelector('.ajax-success-msg');
            if (existingMsg) existingMsg.remove();

            const msgBox = document.createElement('div');
            msgBox.className = 'alert alert-success ajax-success-msg fade show';
            msgBox.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 280px;
            max-width: 350px;
            padding: 12px 18px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 10px;
        `;
            msgBox.innerHTML = `<i class="ti-check text-success fs-5"></i>
                            <span class="flex-grow-1">${message}</span>`;

            document.body.appendChild(msgBox);

            setTimeout(() => {
                msgBox.classList.remove('show');
                setTimeout(() => msgBox.remove(), 300);
            }, 3000);
        }
    </script>
@endsection
