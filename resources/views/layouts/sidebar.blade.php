<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link"> <!--begin::Brand Text--> <span class="brand-text fw-light">ELECTRONIC VOTING</span> <!--end::Brand Text--> </a> <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item"> <a href="{{ route('voters') }}" class="nav-link {{ request()->is('voters') ? 'active' : '' }}"> <i class="nav-icon bi bi-people"></i>
                        <p>Voters</p>
                    </a>
                </li>

                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-bar-chart"></i>
                        <p>
                            Reports
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('reports') }}" class="nav-link"> <i class="bi bi-arrow-right-short"></i>
                                <p>Elections Outcome</p>
                            </a>
                        </li>
{{--                        <li class="nav-item"> <a href="{{ route('all_votes') }}" class="nav-link"> <i class="bi bi-arrow-right-short"></i>--}}
{{--                                <p>Votes</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>

                <li class="nav-item
                    {{ request()->is('voting_positions') ? 'menu-open' : ''}}
                    {{ request()->is('candidates') ? 'menu-open' : ''}}
                    {{ request()->is('ballots') ? 'menu-open' : ''}}
                    "> <a href="#" class="nav-link
                        {{ request()->is('voting_positions') ? 'active' : '' }}
                        {{ request()->is('candidates') ? 'active' : '' }}
                        {{ request()->is('ballots') ? 'active' : '' }}
                    "> <i class="nav-icon bi bi-binoculars"></i>
                        <p>
                            Ballot
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('voting_positions') }}" class="nav-link"> <i class="bi bi-arrow-right-short"></i>
                                <p>Voting Positions</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a href="{{ route('candidates') }}" class="nav-link"> <i class="bi bi-arrow-right-short"></i>
                                <p>Candidates</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a href="{{ route('ballots') }}" class="nav-link"> <i class="bi bi-arrow-right-short"></i>
                                <p>Ballot Positioning</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item
                    {{ request()->is('elections') ? 'menu-open' : ''}}
                    {{ request()->is('users') ? 'menu-open' : ''}}
                   "> <a href="#" class="nav-link
                        {{ request()->is('elections') ? 'active' : '' }}
                        {{ request()->is('users') ? 'active' : '' }}
                        "> <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Settings
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('elections') }}" class="nav-link"> <i class="bi bi-arrow-right-short"></i>
                                <p>Elections Settings</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a href="{{ route('users') }}" class="nav-link"> <i class="bi bi-arrow-right-short"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
