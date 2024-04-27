<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{route('dashboard')}}" class="header-logo">
            <img src="{{asset('assets/images/logo/logo.png"')}}" alt="logo" class="desktop-logo">
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
                <li   class="{{request()->is('*loan*') || request()->is('*product*') ? 'slide has-sub active open' : 'slide has-sub'}}" >
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
                            <a href="alerts.html" class="side-menu__item">Due Loans</a>
                        </li>
                        <li class="slide">
                            <a href="alerts.html" class="side-menu__item">Closed Loans</a>
                        </li>
                        <li class="slide">
                            <a href="badge.html" class="side-menu__item">Principle Outstanding</a>
                        </li>
                        <li class="slide">
                            <a href="breadcrumb.html" class="side-menu__item">Past Maturity</a>
                        </li>
                        <li class="slide">
                            <a href="{{route('product.index')}}"  class="{{request()->is('products/index') ? 'side-menu__item active' : 'side-menu__item'}}">Loan Products</a>
                        </li>
                        <li class="slide">
                            <a href="buttongroup.html" class="side-menu__item">Collaterals</a>
                        </li>
                        <li class="slide">
                            <a href="cards.html" class="side-menu__item">Loan Comments</a>
                        </li>
                        <li class="slide">
                            <a href="cards.html" class="side-menu__item">Loan Approvals</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-medal side-menu__icon"></i>
                        <span class="side-menu__label">Utilities</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Utilities</a>
                        </li>
                        <li class="slide">
                            <a href="avatars.html" class="side-menu__item">Avatars</a>
                        </li>
                        <li class="slide">
                            <a href="borders.html" class="side-menu__item">Borders</a>
                        </li>
                        <li class="slide">
                            <a href="breakpoints.html" class="side-menu__item">Breakpoints</a>
                        </li>
                        <li class="slide">
                            <a href="colors.html" class="side-menu__item">Colors</a>
                        </li>
                        <li class="slide">
                            <a href="columns.html" class="side-menu__item">Columns</a>
                        </li>
                        <li class="slide">
                            <a href="flex.html" class="side-menu__item">Flex</a>
                        </li>
                        <li class="slide">
                            <a href="gutters.html" class="side-menu__item">Gutters</a>
                        </li>
                        <li class="slide">
                            <a href="helpers.html" class="side-menu__item">Helpers</a>
                        </li>
                        <li class="slide">
                            <a href="position.html" class="side-menu__item">Position</a>
                        </li>
                        <li class="slide">
                            <a href="more.html" class="side-menu__item">Additional Content</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-file side-menu__icon"></i>
                        <span class="side-menu__label">Forms</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Forms</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Form Elements
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="form_inputs.html" class="side-menu__item">Inputs</a>
                                </li>
                                <li class="slide">
                                    <a href="form_check_radios.html" class="side-menu__item">Checks &amp; Radios</a>
                                </li>
                                <li class="slide">
                                    <a href="form_input_group.html" class="side-menu__item">Input Group</a>
                                </li>
                                <li class="slide">
                                    <a href="form_select.html" class="side-menu__item">Form Select</a>
                                </li>
                                <li class="slide">
                                    <a href="form_range.html" class="side-menu__item">Range Slider</a>
                                </li>
                                <li class="slide">
                                    <a href="form_input_masks.html" class="side-menu__item">Input Masks</a>
                                </li>
                                <li class="slide">
                                    <a href="form_file_uploads.html" class="side-menu__item">File Uploads</a>
                                </li>
                                <li class="slide">
                                    <a href="form_dateTime_pickers.html" class="side-menu__item">Date,Time Picker</a>
                                </li>
                                <li class="slide">
                                    <a href="form_color_pickers.html" class="side-menu__item">Color Pickers</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a href="floating_labels.html" class="side-menu__item">Floating Labels</a>
                        </li>
                        <li class="slide">
                            <a href="form_layout.html" class="side-menu__item">Form Layouts</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Form Editors
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="quill_editor.html" class="side-menu__item">Quill Editor</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a href="form_validation.html" class="side-menu__item">Validation</a>
                        </li>
                        <li class="slide">
                            <a href="form_select2.html" class="side-menu__item">Select2</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-party side-menu__icon"></i>
                        <span class="side-menu__label">Advanced Ui</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Advanced Ui</a>
                        </li>
                        <li class="slide">
                            <a href="accordions_collpase.html" class="side-menu__item">Accordions &amp; Collapse</a>
                        </li>
                        <li class="slide">
                            <a href="carousel.html" class="side-menu__item">Carousel</a>
                        </li>
                        <li class="slide">
                            <a href="draggable-cards.html" class="side-menu__item">Draggable Cards</a>
                        </li>
                        <li class="slide">
                            <a href="modals_closes.html" class="side-menu__item">Modals &amp; Closes</a>
                        </li>
                        <li class="slide">
                            <a href="navbar.html" class="side-menu__item">Navbar</a>
                        </li>
                        <li class="slide">
                            <a href="offcanvas.html" class="side-menu__item">Offcanvas</a>
                        </li>
                        <li class="slide">
                            <a href="placeholders.html" class="side-menu__item">Placeholders</a>
                        </li>
                        <li class="slide">
                            <a href="ratings.html" class="side-menu__item">Ratings</a>
                        </li>
                        <li class="slide">
                            <a href="scrollspy.html" class="side-menu__item">Scrollspy</a>
                        </li>
                        <li class="slide">
                            <a href="swiperjs.html" class="side-menu__item">Swiper JS</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="widgets.html" class="side-menu__item">
                        <i class="bx bx-gift side-menu__icon"></i>
                        <span class="side-menu__label">Widgets<span class="badge bg-danger-transparent ms-2">Hot</span></span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Web Apps</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-grid-alt side-menu__icon"></i>
                        <span class="side-menu__label">Apps<span class="badge bg-secondary-transparent ms-2">New</span></span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Apps</a>
                        </li>
                        <li class="slide">
                            <a href="full-calendar.html" class="side-menu__item">Full Calendar</a>
                        </li>
                        <li class="slide">
                            <a href="gallery.html" class="side-menu__item">Gallery</a>
                        </li>
                        <li class="slide">
                            <a href="sweet_alerts.html" class="side-menu__item">Sweet Alerts</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Projects<span class="badge bg-secondary-transparent ms-2">New</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="projects-list.html" class="side-menu__item">Projects List</a>
                                </li>
                                <li class="slide">
                                    <a href="projects-overview.html" class="side-menu__item">Project Overview</a>
                                </li>
                                <li class="slide">
                                    <a href="projects-create.html" class="side-menu__item">Create Project</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Jobs<span class="badge bg-secondary-transparent ms-2">New</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="job-details.html" class="side-menu__item">Job Details</a>
                                </li>
                                <li class="slide">
                                    <a href="job-company-search.html" class="side-menu__item">Search Company</a>
                                </li>
                                <li class="slide">
                                    <a href="job-search.html" class="side-menu__item">Search Jobs</a>
                                </li>
                                <li class="slide">
                                    <a href="job-post.html" class="side-menu__item">Job Post</a>
                                </li>
                                <li class="slide">
                                    <a href="jobs-list.html" class="side-menu__item">Jobs List</a>
                                </li>
                                <li class="slide">
                                    <a href="job-candidate-search.html" class="side-menu__item">Search Candidate</a>
                                </li>
                                <li class="slide">
                                    <a href="job-candidate-details.html" class="side-menu__item">Candidate Details</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">NFT<span class="badge bg-secondary-transparent ms-2">New</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="nft-marketplace.html" class="side-menu__item">Market Place</a>
                                </li>
                                <li class="slide">
                                    <a href="nft-details.html" class="side-menu__item">NFT Details</a>
                                </li>
                                <li class="slide">
                                    <a href="nft-create.html" class="side-menu__item">Create NFT</a>
                                </li>
                                <li class="slide">
                                    <a href="nft-wallet-integration.html" class="side-menu__item">Wallet Integration</a>
                                </li>
                                <li class="slide">
                                    <a href="nft-live-auction.html" class="side-menu__item">Live Auction</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">CRM<span class="badge bg-secondary-transparent ms-2">New</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="crm-contacts.html" class="side-menu__item">Contacts</a>
                                </li>
                                <li class="slide">
                                    <a href="crm-companies.html" class="side-menu__item">Companies</a>
                                </li>
                                <li class="slide">
                                    <a href="crm-deals.html" class="side-menu__item">Deals</a>
                                </li>
                                <li class="slide">
                                    <a href="crm-leads.html" class="side-menu__item">Leads</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Crypto<span class="badge bg-secondary-transparent ms-2">New</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="crypto-transactions.html" class="side-menu__item">Transactions</a>
                                </li>
                                <li class="slide">
                                    <a href="crypto-currency-exchange.html" class="side-menu__item">Currency Exchange</a>
                                </li>
                                <li class="slide">
                                    <a href="crypto-buy_sell.html" class="side-menu__item">Buy &amp; Sell</a>
                                </li>
                                <li class="slide">
                                    <a href="crypto-marketcap.html" class="side-menu__item">Marketcap</a>
                                </li>
                                <li class="slide">
                                    <a href="crypto-wallet.html" class="side-menu__item">Wallet</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-layer side-menu__icon"></i>
                        <span class="side-menu__label">Nested Menu</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Nested Menu</a>
                        </li>
                        <li class="slide">
                            <a href="javascript:void(0);" class="side-menu__item">Nested-1</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Nested-2
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="javascript:void(0);" class="side-menu__item">Nested-2-1</a>
                                </li>
                                <li class="slide has-sub">
                                    <a href="javascript:void(0);" class="side-menu__item">Nested-2-2
                                        <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                    <ul class="slide-menu child3">
                                        <li class="slide">
                                            <a href="javascript:void(0);" class="side-menu__item">Nested-2-2-1</a>
                                        </li>
                                        <li class="slide">
                                            <a href="javascript:void(0);" class="side-menu__item">Nested-2-2-2</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Tables &amp; Charts</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-table side-menu__icon"></i>
                        <span class="side-menu__label">Tables<span class="badge bg-success-transparent ms-2">3</span></span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Tables</a>
                        </li>
                        <li class="slide">
                            <a href="tables.html" class="side-menu__item">Tables</a>
                        </li>
                        <li class="slide">
                            <a href="grid-tables.html" class="side-menu__item">Grid JS Tables</a>
                        </li>
                        <li class="slide">
                            <a href="data-tables.html" class="side-menu__item">Data Tables</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-bar-chart-square side-menu__icon"></i>
                        <span class="side-menu__label">Charts</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Charts</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Apex Charts
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="apex-line-charts.html" class="side-menu__item">Line Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-area-charts.html" class="side-menu__item">Area Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-column-charts.html" class="side-menu__item">Column Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-bar-charts.html" class="side-menu__item">Bar Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-mixed-charts.html" class="side-menu__item">Mixed Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-rangearea-charts.html" class="side-menu__item">Range Area Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-timeline-charts.html" class="side-menu__item">Timeline Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-candlestick-charts.html" class="side-menu__item">CandleStick
                                        Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-boxplot-charts.html" class="side-menu__item">Boxplot Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-bubble-charts.html" class="side-menu__item">Bubble Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-scatter-charts.html" class="side-menu__item">Scatter Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-heatmap-charts.html" class="side-menu__item">Heatmap Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-treemap-charts.html" class="side-menu__item">Treemap Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-pie-charts.html" class="side-menu__item">Pie Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-radialbar-charts.html" class="side-menu__item">Radialbar Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-radar-charts.html" class="side-menu__item">Radar Charts</a>
                                </li>
                                <li class="slide">
                                    <a href="apex-polararea-charts.html" class="side-menu__item">Polararea Charts</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a href="chartjs-charts.html" class="side-menu__item">Chartjs Charts</a>
                        </li>
                        <li class="slide">
                            <a href="echarts.html" class="side-menu__item">Echart Charts</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Maps &amp; Icons</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-map side-menu__icon"></i>
                        <span class="side-menu__label">Maps</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Maps</a>
                        </li>
                        <li class="slide">
                            <a href="google-maps.html" class="side-menu__item">Google Maps</a>
                        </li>
                        <li class="slide">
                            <a href="leaflet-maps.html" class="side-menu__item">Leaflet Maps</a>
                        </li>
                        <li class="slide">
                            <a href="vector-maps.html" class="side-menu__item">Vector Maps</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="icons.html" class="side-menu__item">
                        <i class="bx bx-store-alt side-menu__icon"></i>
                        <span class="side-menu__label">Icons</span>
                    </a>
                </li>
                <!-- End::slide -->
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->
