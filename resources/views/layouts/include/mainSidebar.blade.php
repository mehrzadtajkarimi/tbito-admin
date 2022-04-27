<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item has-treeview @yield('sidebar-settings')">
                        <a href="#" class="nav-link @yield('sidebar-settings')">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class=" img-fluid img-circle " src="{{ asset('/admin/dist/img/user.png')}}" alt="User profile picture">
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex flex-column align-self-center align-content-around">
                                        <span class="brand-text font-weight-light">{{ auth('admin')->user()->name }}</span>
                                        <span class="brand-text font-weight-light " style="font-size:70%;">{{ auth('admin')->user()->post }}</span>
                                    </div>
                                </div>
                                <i class="right fa fa-angle-left mt-2"></i>
                            </div>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('permission-read')
                            <li class="nav-item">
                                <a href="{{ route('permission.index') }}" class="nav-link  @yield('sidebar-permission')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>لیست دسترسی ها </small>
                                </a>
                            </li>
                            @endcan
                            @can('role-read')
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link @yield('sidebar-role')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>لیست نقش ها </small>
                                </a>
                            </li>
                            @endcan
                            @can('admin-read')
                            <li class="nav-item">
                                <a href="{{ route('admins.index') }}" class="nav-link @yield('sidebar-admins')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>لیست ادمین ها </small>
                                </a>
                            </li>
                            @endcan
                            @can('activity-log-read')
                            <li class="nav-item">
                                <a href="{{ route('activity-log.index') }}" class="nav-link @yield('sidebar-activity-log')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>ریز فعالیت سایت </small>
                                </a>
                            </li>
                            @endcan
                            @can('api-log-read')
                            <li class="nav-item">
                                <a href="{{ route('api-log.index') }}" class="nav-link @yield('sidebar-api-log')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>فراخوانی های api</small>
                                </a>
                            </li>
                            @endcan
                            @can('admin-self-read')
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link @yield('sidebar-profile')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>پروفایل </small>
                                </a>
                            </li>
                            @endcan
                            @can('site-settings-read')
                            <li class="nav-item">
                                <a href="{{ route('site-setting.index') }}" class="nav-link @yield('sidebar-site-setting')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>تنظیمات سایت </small>
                                </a>
                            </li>
                            @endcan
                            <form action="{{ route('logout') }}" method="post" class="">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-block border-0  ">
                                    <i class="fas fa-sign-out-alt text-danger float-right mr-3"></i>
                                    <span class=" text-danger float-right mr-2">خروج</span>
                                </button>
                            </form>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="/" class="nav-link @yield('sidebar-dashboard')">
                            <i class="far fa-circle ml-2"></i>
                            <p> داشبورد</p>
                        </a>
                    </li>

                    @can('deposit-irt-read')
                    <li class="nav-item">
                        <a href="{{ route('deposits-irt.index') }}" class="nav-link  @yield('sidebar-deposits-irt') ">
                            <i class="far fa-circle ml-2"></i>
                            <p> واریز های ریالی</p>
                        </a>
                    </li>
                    @endcan
                    @can('deposit-read')
                    <li class="nav-item">
                        <a href="{{ route('deposits.index') }}" class="nav-link  @yield('sidebar-deposits')">
                            <i class="far fa-circle ml-2"></i>
                            <p> واریز های رمز ارزی</p>
                        </a>
                    </li>
                    @endcan
                    @can('withdraws-irt-read')
                    <li class="nav-item">
                        <a href="{{ route('withdrawIrt.index') }}" class="nav-link  @yield('sidebar-withdrawIrt')">
                            <i class="far fa-circle ml-2"></i>
                            <p>برداشت های ریالی</p>
                        </a>
                    </li>
                    @endcan
                    @can('withdraws-read')
                    <li class="nav-item">
                        <a href="{{ route('withdraw.index') }}" class="nav-link @yield('sidebar-withdraw')">
                            <i class="far fa-circle ml-2"></i>
                            <p>برداشت های رمز ارزی</p>
                        </a>
                    </li>
                    @endcan
                    @can('ticket-read')
                    <li class="nav-item">
                        <a href="{{ route('ticket.index') }}" class="nav-link  @yield('sidebar-ticket')">
                            <i class="far fa-circle ml-2"></i>
                            <p>تیکت ها </p>
                        </a>
                    </li>
                    @endcan
                    @can('wallet-address-read')
                    <li class="nav-item">
                        <a href="{{ route('walletAddress.index') }}" class="nav-link  @yield('sidebar-walletAddress')">
                            <i class="far fa-circle ml-2"></i>
                            <p> آدرسهای کیف پول</p>
                        </a>
                    </li>
                    @endcan
                    @can('contact-us-read')
                    <li class="nav-item">
                        <a href="{{ route('ContactUs.index') }}" class="nav-link @yield('sidebar-ContactUs')">
                            <i class="far fa-circle ml-2"></i>
                            <p>پیام های تماس با ما</p>
                        </a>
                    </li>
                    @endcan
                    @can('user-read')
                    <li class="nav-item has-treeview @yield('sidebar-users') ">
                        <a href="#" class="nav-link @yield('sidebar-users') ">
                            <i class="far fa-circle ml-2"></i>
                            <p>
                                مدیریت کاربران
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link @yield('sidebar-user') ">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>لیست کاربران</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index', ['waiting' => 1]) }}" class="nav-link @yield('sidebar-user-waiting')">
                                    <i class="far fa-dot-circle  ml-2 mr-3"></i>
                                    <small>کاربران در انتظار تایید</small>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('currency-read')
                    <li class="nav-item has-treeview  @yield('sidebar-currencies')">
                        <a href="#" class="nav-link @yield('sidebar-currencies')">
                            <i class="far fa-circle ml-2"></i>
                            <p>
                                تنظیمات مارکت-رمزارز
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('currency.index') }}" class="nav-link  @yield('sidebar-currency')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>مدیریت رمزارزها</small>
                                </a>
                            </li>
                            @can('market-read')
                            <li class="nav-item">
                                <a href="{{ route('market.index') }}" class="nav-link  @yield('sidebar-market')">
                                    <i class="far fa-dot-circle  ml-2 mr-3"></i>
                                    <small>مدیریت مارکتها</small>
                                </a>
                            </li>
                            @endcan
                            @can('commission-read')
                            <li class="nav-item">
                                <a href="{{ route('commission.index') }}" class="nav-link  @yield('sidebar-commission')">
                                    <i class="far fa-dot-circle  ml-2 mr-3"></i>
                                    <small>مدیریت کارمزد معاملات</small>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('order-read')
                    <li class="nav-item has-treeview @yield('sidebar-orders')">
                        <a href="#" class="nav-link @yield('sidebar-orders')">
                            <i class="far fa-circle ml-2"></i>
                            <p>
                                سفارشات و تریدها
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('order.index') }}" class="nav-link @yield('sidebar-order')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>لیست سفارش ها</small>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('order.index',['status' => 2]) }}" class="nav-link @yield('sidebar-order-waiting')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>سفارش های باز</small>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('report-wallet-read')
                    <li class="nav-item has-treeview  @yield('sidebar-reports')">
                        <a href="#" class="nav-link @yield('sidebar-reports')">
                            <i class="far fa-circle ml-2"></i>
                            <p>
                                مدیریت مالی و گزارش ها
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('reportWallet.index') }}" class="nav-link @yield('sidebar-reportWallet')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>گزارش صندوق</small>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('siteFee.index') }}" class="nav-link   @yield('sidebar-siteFee')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>گزارش عملکرد</small>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('siteTransaction.create') }}" class="nav-link   @yield('sidebar-siteTransaction')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>ثبت تراکنش کیف خارجی</small>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan




                    <li class="nav-item has-treeview @yield('sidebar-contents')">
                        <a href="#" class="nav-link @yield('sidebar-contents')">
                            <i class="far fa-circle ml-2"></i>
                            <p>
                                مدیریت محتوای سایت
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        @can('slideshow-read')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('slideshow.index') }}" class="nav-link  @yield('sidebar-slideshow')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>اسلاید شو</small>
                                </a>
                            </li>
                        </ul>
                        @endcan
                        @can('site-content-read')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('siteContent.index') }}" class="nav-link   @yield('sidebar-siteContent')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>سایر اطلاعات</small>
                                </a>
                            </li>
                        </ul>
                        @endcan
                        @can('news-read')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('siteFee.index') }}" class="nav-link @yield('sidebar-siteFee')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>اخبار و اطلاعیه ها</small>
                                </a>
                            </li>
                        </ul>
                        @endcan
                        @can('policies-read')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('policies.index') }}" class="nav-link  @yield('sidebar-policies')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>قوانین</small>
                                </a>
                            </li>
                        </ul>
                        @endcan
                        @can('about-read')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('about.index') }}" class="nav-link  @yield('sidebar-about')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>در باره ما</small>
                                </a>
                            </li>
                        </ul>
                        @endcan
                        @can('commission-text-read')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('policies.index') }}" class="nav-link  @yield('sidebar-commission-text')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>کارمزدها</small>
                                </a>
                            </li>
                        </ul>
                        @endcan
                        @can('faq-cat-read')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('policies.index') }}" class="nav-link  @yield('sidebar-faq-cat')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>دسته بندی ها</small>
                                </a>
                            </li>
                        </ul>
                        @endcan
                        @can('faq-read')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('policies.index') }}" class="nav-link @yield('sidebar-faq-read')">
                                    <i class="far fa-dot-circle ml-2 mr-3"></i>
                                    <small>پرسش و پاسخ های</small>
                                </a>
                            </li>
                        </ul>
                        @endcan
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->

</aside>