@role('super-admin')
@else
<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{asset('vendors/images/favicon-32x32.png')}}" alt="" class="dark-logo">
            <img src="{{asset('vendors/images/favicon-32x32.png')}}" alt="" class="light-logo">UTT-MANAGER
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dashbord</span>
                    </a>
                </li>
                @role('admin')
                @else
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-edit2"></span><span class="mtext">User Manager</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="form-basic.html">Role</a></li>
                        <li><a href="advanced-components.html">Permission</a></li>
                        <li><a href="{{route('user-list')}}">User List</a></li>
                    </ul>
                </li>
                @endrole
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-edit2"></span><span class="mtext">Bookings</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="form-basic.html">All Availability</a></li>
                        <li><a href="advanced-components.html">All Bookings</a></li>
                        <li><a href="form-wizard.html">Late Availability</a></li>
                        <li><a href="html5-editor.html">Cleaning Rota</a></li>
                        <li><a href="form-pickers.html">Discount Code Manager</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-library"></span><span class="mtext">Properties</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="basic-table.html">Properties Manager</a></li>
                        <li><a href="datatable.html">Categories</a></li>
                        <li><a href="datatable.html">FEATURES</a></li>
                        <li><a href="datatable.html">REVIEWS MANAGER</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-apartment"></span><span class="mtext"> Settings </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="ui-buttons.html">Pricing Overview</a></li>
                        <li><a href="ui-cards.html">Set Princing Seasons</a></li>
                        <li><a href="ui-cards-hover.html">Set Pricing Categories</a></li>
                        <li><a href="ui-modals.html">Booking Confoirmation</a></li>
                        <li><a href="ui-tabs.html">Manage Users</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-paint-brush"></span><span class="mtext">Reports</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="font-awesome.html">Sales Report</a></li>
                        <li><a href="foundation.html">Property Accounts</a></li>
                        <li><a href="ionicons.html">Owner Accounts</a></li>
                        <li><a href="themify.html">Owner Statements</a></li>
                        <li><a href="custom-icon.html">Annual Report</a></li>
                        <li><a href="custom-icon.html">Performance Analytics</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-analytics-21"></span><span class="mtext">Emails & Notifications</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-right-arrow1"></span><span class="mtext">Website Manager</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endrole
