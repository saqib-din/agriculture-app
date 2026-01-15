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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Teams</a></li>
                                <li class="breadcrumb-item">{{ isset($team) ? 'Edit' : 'Add' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ isset($team) ? 'Team Edit' : 'Team Add' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <form action="{{ route('teams.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $team->id ?? '' }}">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Team Information</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter name" value="{{ old('name', $team->name ?? '') }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Designation <span class="text-danger">*</span></label>
                                            <input type="text" name="designation" class="form-control"
                                                placeholder="Enter designation"
                                                value="{{ old('designation', $team->designation ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select" required>
                                                <option value="Active"
                                                    {{ old('status', $team->status ?? '') == 'Active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="Inactive"
                                                    {{ old('status', $team->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Enter description"
                                                value="{{ old('description', $team->description ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="number" name="phone" class="form-control"
                                                placeholder="Enter phone number"
                                                value="{{ old('phone', $team->phone ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control"
                                                placeholder="Enter email" value="{{ old('email', $team->email ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">LinkedIn</label>
                                            <input type="text" name="linkedin" class="form-control"
                                                placeholder="Enter LinkedIn profile URL"
                                                value="{{ old('linkedin', $team->linkedin ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" name="facebook" class="form-control"
                                                placeholder="Enter Facebook profile URL"
                                                value="{{ old('facebook', $team->facebook ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" name="instagram" class="form-control"
                                                placeholder="Enter Instagram profile URL"
                                                value="{{ old('instagram', $team->instagram ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Is CEO</label>
                                            <select name="is_ceo" class="form-select" required>
                                                <option value="0"
                                                    {{ old('is_ceo', $team->is_ceo ?? 0) == 0 ? 'selected' : '' }}>No
                                                </option>
                                                <option value="1"
                                                    {{ old('is_ceo', $team->is_ceo ?? 0) == 1 ? 'selected' : '' }}>Yes
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Profile Image</label>
                                            <input class="form-control" type="file" name="image" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary">
                                            {{ isset($team) ? 'Update' : 'Submit' }}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
