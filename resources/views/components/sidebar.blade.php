<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{route('dashboard')}}" class="header-logo">
            <p class="fw-bold  fs-6" style="color: #aa166d">Minajo Finance LTD</p>
{{--            <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo" class="desktop-logo">--}}
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Main</span></li>
                <!-- End::slide__category -->

                <li class="slide">
                    <a href="{{route('dashboard')}}"  class="{{request()->is('dashboard') ? 'side-menu__item active' : 'side-menu__item'}}" >
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Customer Management</span></li>

                <li class="slide">
                    <a href="{{route('borrow.index')}}"  class="{{request()->is('*borrower*') ? 'side-menu__item active' : 'side-menu__item'}}" >
                        <i class="bx bx-group side-menu__icon"></i>
                        <span class="side-menu__label">Customers</span>
                    </a>
                </li>



                <li class="slide">
                    <a href="{{route('group.index')}}"  class="{{request()->is('*group*') ? 'side-menu__item active' : 'side-menu__item'}}" >
                        <i class="bx bx-layer-plus side-menu__icon"></i>
                        <span class="side-menu__label">Customers Group</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{route('guarantor.index')}}"  class="{{request()->is('*guarantor*') ? 'side-menu__item active' : 'side-menu__item'}}" >
                        <i class="bx bx-user side-menu__icon"></i>
                        <span class="side-menu__label">Guarantors</span>
                    </a>
                </li>

                <li class="slide__category"><span class="category-name">Loan Management</span></li>
                <!-- Start::slide -->
                <li   class="{{request()->is('*loan*') || request()->is('*product*')  ||
                  request()->is('*schedule*') || request()->is('*collateral*')  ? 'slide has-sub active open' : 'slide has-sub'}}" >
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-box side-menu__icon"></i>
                        <span class="side-menu__label">Loans</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1 mega-menu">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Loans</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('loan.index')}}"  class="{{request()->is('loans/index') ? 'side-menu__item active' : 'side-menu__item'}}" >Loans List</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('schedule.index')}}"  class="{{request()->is('schedules/index') ? 'side-menu__item active' : 'side-menu__item'}}">Due Loans</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('loan.closed')}}"  class="{{request()->is('loans/closed') ? 'side-menu__item active' : 'side-menu__item'}}">Closed Loans</a>
                        </li>

                        <li class="slide">
                            <a href="{{route('schedule.maturity')}}"  class="{{request()->is('schedules/maturity') ? 'side-menu__item active' : 'side-menu__item'}}">Past Maturity</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('loan.settlement')}}"  class="{{request()->is('loans/settlement') ? 'side-menu__item active' : 'side-menu__item'}}">Cash Settlement</a>
                        </li>

                        <li class="slide">
                            <a href="{{route('loan.rollover')}}"  class="{{request()->is('loans/rollover') ? 'side-menu__item active' : 'side-menu__item'}}">Loan Rollover</a>
                        </li>

                        <li class="slide">
                            <a href="{{route('product.index')}}"  class="{{request()->is('products/index') ? 'side-menu__item active' : 'side-menu__item'}}">Loan Products</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('collateral.index')}}"  class="{{request()->is('collaterals/index') ? 'side-menu__item active' : 'side-menu__item'}}">Collaterals</a>
                        </li>

                        <li class="slide">
                            <a href="{{route('collateral.showComment')}}"  class="{{request()->is('collaterals/comment_index') ? 'side-menu__item active' : 'side-menu__item'}}">Loan Comments</a>
                        </li>
                        @can('loan_approve')
                        <li class="slide">
                            <a href="{{route('approve.index')}}"  class="{{request()->is('approvals/index') ? 'side-menu__item active' : 'side-menu__item'}}">Loan Approvals</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Payment</span></li>
                <!-- End::slide__category -->
                <!-- Start::slide -->
                <li  class="{{request()->is('*payment*')   ? 'slide has-sub active open' : 'slide has-sub'}}" >
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-money-withdraw side-menu__icon"></i>
                        <span class="side-menu__label">Repayments</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{route('payment.index')}}" class="{{request()->is('payments/index') ? 'side-menu__item active' : 'side-menu__item'}}">Payments</a>
                        </li>
                        @can('loan_approve')
                        <li class="slide">
                            <a href="{{route('payment.chart')}}" class="{{request()->is('payments/chart') ? 'side-menu__item active' : 'side-menu__item'}}">Payment Chart</a>
                        </li>
                        @endcan
                        <li class="slide">
                            <a href="{{route('payment.collection')}}" class="{{request()->is('payments/collection') ? 'side-menu__item active' : 'side-menu__item'}}">Collection Report</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Settings</span></li>
                <!-- End::slide__category -->
                @can('loan_approve')
                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-cog side-menu__icon"></i>
                        <span class="side-menu__label">Settings</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">

                        <li class="slide">
                            <a href="{{route('collateraltype.index')}}" class="side-menu__item">Loan Security Types</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('user.index')}}" class="{{request()->is('users/index') ? 'side-menu__item active' : 'side-menu__item'}}">User Management</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('interest.index')}}" class="{{request()->is('interests/index') ? 'side-menu__item active' : 'side-menu__item'}}">Interest Percent</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('penalty.index')}}" class="{{request()->is('penaltys/index') ? 'side-menu__item active' : 'side-menu__item'}}">Penalty</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('company.index')}}" class="{{request()->is('companies/index') ? 'side-menu__item active' : 'side-menu__item'}}">Payment Method</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->
                @endcan

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->
