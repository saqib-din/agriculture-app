<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">

                        <div class="flex-shrink-0">
                            <a href="{{ route('dashboard') }}">
                                <img src="{{ asset('admin/assets/images/user/avatar-1.jpg') }}" alt="user"
                                    class="user-avtar rounded-circle" style="width: 50px; height: 50px;" />
                            </a>
                        </div>

                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0">
                                {{ Auth::user()->name }}
                            </h6>
                        </div>

                    </div>
                </div>
            </div>
            <ul class="pc-navbar">

                <li class="pc-item pc-caption">
                    <label data-i18n="Navigation">Navigation</label>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('hero-section.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-layer"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Hero">Hero Section</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('services.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-link"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Services">Services</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('products.list') }}" class="pc-link">
                        <span class="pc-micon">
                             <svg class="pc-icon">
                                <use xlink:href="#custom-element-plus"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Products">Products</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-cpu-charge"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Categories">Categories</span>
                    </a>
                </li>

                {{-- <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-element-plus"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="List">List</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('products.list') }}"
                                data-i18n="Products">Products</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('index') }}"
                                data-i18n="Categories">Categories</a></li>
                    </ul>
                </li> --}}

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('admin.quotes.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-mouse-circle"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Quotations">Quotations</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{ route('admin.clients.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="pc-mtext">Clients</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.orders.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-shopping-cart"></i>
                        </span>
                        <span class="pc-mtext">Orders</span>
                    </a>
                </li>


                {{-- <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Clients & Orders</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="#">
                                <i class="ti ti-users"></i> Clients
                            </a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="#">
                                <i class="ti ti-shopping-cart"></i> Orders
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('teams.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-story"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Teams">Teams</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('testimonials.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-box-1"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Testimonials">Testimonials</span>
                        <span class="pc-arrow"></span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('faqs.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-graph"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Faqs">Faqs</span>
                        <span class="pc-arrow"></span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{ route('variables.create') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-keyboard"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Variables">Variables</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('pages.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-crop"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Pages">Pages</span><span class="pc-arrow"></span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('admin.contacts.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-24-support"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Contacts">Contacts</span><span class="pc-arrow"></span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('partners.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-image"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Partners">Partners</span>
                        <span class="pc-arrow"></span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('users.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-user-square"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Users">Users</span><span class="pc-arrow"></span>
                    </a>
                </li>

                {{-- <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-setting-2"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Application">App Settings</span><span
                            class="pc-arrow"></span>
                    </a>
                </li> --}}

            </ul>
        </div>
    </div>
</nav>
