@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- Breadcrumb -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Contacts</a></li>
                                <li class="breadcrumb-item" aria-current="page">List</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Contacts List</h2>
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
                            <h5>Contacts List</h5>
                        </div>
                        <div class="card-body table-card">

                            @if ($contacts->count() == 0)
                                <div class="text-center" style="min-height: 300px;">
                                    <img src="{{ asset('admin/assets/images/application/img-empty-mail.png') }}"
                                        alt="img" class="img-fluid mb-4">
                                    <h2><b>There is No Mail</b></h2>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover" id="pc-dt-simple-1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Phone</th>
                                                <th>Is Replied</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contacts as $contact)
                                                <tr>
                                                    <td>{{ $contact->id }}</td>
                                                    <td>{{ $contact->name }}</td>
                                                    <td>{{ $contact->email }}</td>
                                                    <td>{{ $contact->subject }}</td>
                                                    <td>{{ $contact->phone }}</td>
                                                    <td><span
                                                            class="badge bg-light-{{ $contact->is_replied ? 'success' : 'danger' }}">{{ $contact->is_replied ? 'Yes' : 'No' }}</span>
                                                    </td>
                                                    <td class="text-end">

                                                        <!-- View Contact Modal -->
                                                        <a href="#" class="avtar avtar-xs btn-link-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewModal{{ $contact->id }}" title="View">
                                                            <i class="ti ti-eye f-20"></i>
                                                        </a>

                                                        <!-- Reply Contact Modal -->
                                                        @if (!$contact->is_replied)
                                                            <a href="#" class="avtar avtar-xs btn-link-secondary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#replyModal{{ $contact->id }}"
                                                                title="Reply">
                                                                <i
                                                                    class="align-text-bottom me-1 ti ti-arrow-back-up f-20"></i>
                                                            </a>
                                                        @endif

                                                        <!-- Delete -->
                                                        <a href="#"
                                                            class="avtar avtar-xs btn-link-secondary bs-pass-para"
                                                            data-id="{{ $contact->id }}" title="Delete">
                                                            <i class="ti ti-trash f-20"></i>
                                                        </a>

                                                        <!-- Hidden Delete Form -->
                                                        <form id="delete-form-{{ $contact->id }}"
                                                            action="{{ route('admin.contacts.delete', $contact->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                    </td>
                                                </tr>
                                                
                                                <!-- View Modal -->
                                                <div class="modal fade" id="viewModal{{ $contact->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content border-0 shadow-lg rounded-4">
                                                            <div class="modal-header text-white">
                                                                <h5 class="modal-title fw-bold">Contact Details</h5>
                                                                <button type="button" class="btn-close btn-close-danger"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <dl class="row mb-0">
                                                                    <dt class="col-sm-4 text-muted">ID</dt>
                                                                    <dd class="col-sm-8">{{ $contact->id }}</dd>

                                                                    <dt class="col-sm-4 text-muted">Message</dt>
                                                                    <dd class="col-sm-8">{{ $contact->message }}</dd>

                                                                    <dt class="col-sm-4 text-muted">Terms Accepted</dt>
                                                                    <dd class="col-sm-8">
                                                                        {{ $contact->terms_accepted_time ?? '-' }}</dd>

                                                                    <dt class="col-sm-4 text-muted">User Agent</dt>
                                                                    <dd class="col-sm-8">{{ $contact->user_agent ?? '-' }}
                                                                    </dd>

                                                                    <dt class="col-sm-4 text-muted">IP Address</dt>
                                                                    <dd class="col-sm-8">{{ $contact->ip_address ?? '-' }}
                                                                    </dd>

                                                                    <dt class="col-sm-4 text-muted">Admin Reply</dt>
                                                                    <dd class="col-sm-8">
                                                                        {{ $contact->reply_message ?? 'No reply yet' }}
                                                                    </dd>

                                                                    <dt class="col-sm-4 text-muted">Replied At</dt>
                                                                    <dd class="col-sm-8">
                                                                        {{ $contact->replied_at ?? 'No reply yet' }}</dd>
                                                                </dl>
                                                            </div>
                                                            <div class="modal-footer border-top-0">
                                                                <button type="button"
                                                                    class="btn btn-outline-secondary rounded-pill"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Reply Modal -->
                                                <div class="modal fade" id="replyModal{{ $contact->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                        <div class="modal-content border-0 shadow">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reply to {{ $contact->name }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form
                                                                action="{{ url('/admin/contacts/' . $contact->id . '/reply') }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Message</label>
                                                                        <textarea name="reply_message" class="form-control" rows="5" required>{{ $contact->reply_message ?? '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-light-info">Send
                                                                        Reply</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @push('scripts')
        <script>
            $(document).ready(function() {
                $('#pc-dt-simple-1').DataTable();
            });
        </script>
    @endpush --}}
@endsection
