@extends('layouts.admin')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Products</a></li>
                                <li class="breadcrumb-item" aria-current="page">Add</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Product Add</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Product Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" class="form-control" placeholder="Enter product name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control" placeholder="Enter price" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" placeholder="Enter description" />
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Registration Date</label>
                                        <input type="date" class="form-control" />
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Specifications</label>
                                        <input type="text" class="form-control" placeholder="Enter specifications" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select">
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Attachment</label>
                                        <input type="text" class="form-control" placeholder="Enter attachment" />
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Gender</label>
                                        <select class="form-select">
                                            <option>Female</option>
                                            <option>Male</option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Parents Name</label>
                                        <input type="text" class="form-control" placeholder="Enter parents name" />
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Parents Mobile Number</label>
                                        <input type="number" class="form-control"
                                            placeholder="Enter parents mobile number" />
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" />
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Blood Group</label>
                                        <input type="text" class="form-control" placeholder="Enter blood group" />
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Shipping Address</label>
                                        <textarea class="form-control" rows="2" placeholder="Enter address"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">File</label>
                                        <input class="form-control" type="file" />
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
