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
                                <li class="breadcrumb-item" aria-current="page">Pages</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Pages</h2>
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
                                <h5 class="mb-3 mb-sm-0">Pages List</h5>
                                <div>
                                    <a href="{{ route('pages.create') }}" class="btn btn-primary">
                                        Add Page
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Display in Footer</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pages as $index => $page)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <h6 class="mb-0">{{ $page->name }}</h6>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-warning">{{ $page->slug }}</span>
                                                </td>

                                                <td>
                                                    @if ($page->display_in_footer == 1)
                                                        <span class="badge bg-light-info">Yes</span>
                                                    @else
                                                        <span class="badge bg-light-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($page->status == 'Active')
                                                        <span class="badge bg-light-success">Active</span>
                                                    @else
                                                        <span class="badge bg-light-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">

                                                    <a href="#" class="avtar avtar-xs btn-link-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewPageModal{{ $page->id }}">
                                                        <i class="ti ti-eye f-20"></i>
                                                    </a>

                                                    <a href="{{ route('pages.edit', $page->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary" title="Edit">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>
                                                    <a href="#" class="avtar avtar-xs btn-link-secondary bs-pass-para"
                                                        data-id="{{ $page->id }}" title="Delete">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>

                                                    <!-- Hidden form -->
                                                    <form id="delete-form-{{ $page->id }}"
                                                        action="{{ route('pages.destroy', $page->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                                <!-- View Modal -->
                                                <div class="modal fade" id="viewPageModal{{ $page->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $page->name }} - Content
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $page->content !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 pb-0">
                                                    <div class="text-muted">
                                                        <i class="ti ti-file-off" style="font-size: 48px;"></i>
                                                        <p class="mt-2">No pages found. Create your first page!</p>
                                                    </div>
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
@endsection
