@role('super-admin')
@else
    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="index.html">
                <img src="{{asset('vendors/images/favicon-32x32.png')}}" alt="" class="dark-logo">
                <img src="{{asset('admin-dashboard-layout/images/favicon-32x32.png')}}" alt="" class="light-logo">UTT-MANAGER
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="{{route('dashboard')}}" class="dropdown-toggle no-arrow" >
                            <span class="micon dw dw-house-1"></span><span class="mtext">Dashbord </span>
                        </a>
                    </li>
                    @role('owner')
                    @else
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-users"></span><span class="mtext">User Manager</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{route('owner-list')}}">Owner List</a></li>
                                <li><a href="{{route('user-list')}}">User List</a></li>
                                <li><a href="{{route('customer-list')}}">Customer List</a></li>
                            </ul>
                        </li>
                        @endrole
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-pencil"></span><span class="mtext">Bookings</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{route('availability-list')}}">All Availability</a></li>
                                <li><a href="{{route('booking-list')}}">All Bookings</a></li>
                                <li><a href="{{route('late-availability-list')}}">Late Availability</a></li>
                                <li><a href="{{route('cleaningRotaList')}}">Cleaningg Rota</a></li>
                                <li><a href="{{route('discount-list')}}">Discount Code Manager</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon dw dw-library"></span><span class="mtext">Properties</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{route('property-list')}}">Properties Manager</a></li>
                                <li><a href="{{route('propert-category-list')}}">Categories</a></li>
                                <li><a href="{{route('feature-list')}}">FEATURES</a></li>
                                <li><a href="{{route('review-list')}}">REVIEWS MANAGER</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon dw fi-widget"></span><span class="mtext"> Settings </span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{route('price-list')}}">Pricing Overview</a></li>
                                <li><a href="{{route('price-season-list')}}">Set Princing Seasons</a></li>
                                <li><a href="{{route('price-category-list')}}">Set Pricing Categories</a></li>
                                {{--<li><a href="{{route('price-type-list')}}">Pricing Types</a></li>--}}
                                <li><a href="{{route('booking-confirmation')}}">Booking Confirmation</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon dw fi-page-filled"></span><span class="mtext">Reports</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="font-awesome.html">Sales Report</a></li>
                                <li><a href="foundation.html">Property Accounts</a></li>
                                <li><a href="ionicons.html">Owner Accounts</a></li>
                                <li><a href="{{route('owner-data')}}">Owner Statements</a></li>
                                <li><a href="custom-icon.html">Annual Report</a></li>
                                <li><a href="custom-icon.html">Performance Analytics</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-envelope-open"></span><span
                                        class="mtext">Emails & Notifications</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle no-arrow">
                                <span class="micon fa fa-user"></span><span class="mtext">Website Manager</span>
                            </a>
                        </li>
                </ul>
            </div>
        </div>
    </div>
@endrole