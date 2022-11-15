<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="user-pic">
                            <img src="{{ asset('dashboard_files/assets/images/users/1.jpg') }}" alt="users"
                                class="rounded-circle img-fluid" />
                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="m-b-10 user-name font-medium">{{ auth()->user()->name }}</h5>
                            <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-settings"></i>
                            </a>
                            <a href=" {{ route('auth.logout') }}" title="Logout" class="btn btn-circle btn-sm">
                                <i class="ti-power-off"></i>
                            </a>
                            <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">المستخدمين</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('users.create') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">create</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('users.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">index</span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">التصنيفات</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('categories.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">index</span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">المنتجات</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('products.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">كل المنتجات</span>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-shopping"></i>
                        <span class="hide-menu">{{__('الطلبات')}}</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('orders-product.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">{{__('أدارة طلبات المنتجات')}}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('orders.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">{{__('أدارة الطلبات الخارجية')}}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('products-cart') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">{{__('المنتجات')}}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('cart') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">{{__('سلة المشتريات')}}</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('order-cases.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">{{__('حالات الطلب')}}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('delivery-drivers.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">{{__('السائقين')}}</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">التقارير</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('reports.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">index</span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">إدارة سيارات النقل</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('transport.create')}}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">إنشاء</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('transport.index')}}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">عرض</span>
                            </a>
                        </li>


                    </ul>
                </li>

                      <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">إدارة الزبائن</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('customer.create')}}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">إنشاء</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('customer.index')}}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">عرض</span>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">إدارة التوصيل</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('delivery.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">عرض</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('delivery.create') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">انشاء</span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">إدارة النقاط</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('points-management.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">عرض</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('points-transfer.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">عمليات التحويل</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('order-points.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">نقاط الطلبات </span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="icon-Wrench"></i>
                        <span class="hide-menu">الإعدادت</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('settings.create') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">إنشاء</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('settings.index') }}" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu">عرض</span>
                            </a>
                        </li>


                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
