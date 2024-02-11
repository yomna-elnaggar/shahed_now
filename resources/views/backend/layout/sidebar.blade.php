<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{route('admin.dashboard')}}">
                <img class="d-none d-lg-block blur-up lazyloaded"
                    src="{{asset('assets')}}/images/dashboard/multikart-logo.png" alt="">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar">
        <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times"
                aria-hidden="true"></i></a>
        <div class="sidebar-user">
            <img class="img-60" src="{{asset('assets')}}/images/dashboard/user3.jpg" alt="#">
            <div>
                <h6 class="f-14">shahed</h6>
                <p> .sport live</p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a class="sidebar-header" href="{{route('admin.dashboard')}}">
                    <i data-feather="home"></i>
                    <span>لوحة التحكم</span>
                </a>
            </li>

            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="box"></i>
                    <span>الباقات</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('package.all')}}">
                            <i class="fa fa-circle"></i>
                            <span>عرض الباقات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('package.create')}}">
                            <i class="fa fa-circle"></i>
                            <span>اضافة باقات </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="move"></i>
                    <span>الدوريات</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('category.all')}}">
                            <i class="fa fa-circle"></i>
                            <span>عرض الدوريات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('category.create')}}">
                            <i class="fa fa-circle"></i>
                            <span>اضافة الدوريات </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="users"></i>
                    <span>الفرق</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('team.all')}}">
                            <i class="fa fa-circle"></i>
                            <span>عرض الفرق</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('team.create')}}">
                            <i class="fa fa-circle"></i>
                            <span>اضافة فريق </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="dribbble"></i>
                    <span>المباريات</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('FootballMatch.all')}}">
                            <i class="fa fa-circle"></i>
                            <span>عرض المباريات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('FootballMatch.create')}}">
                            <i class="fa fa-circle"></i>
                            <span>اضافة مباراة</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="sidebar-header" href="{{route('ContactUs.all')}}">
                    <i data-feather="message-circle"></i>
                    <span>الرسائل </span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="clipboard"></i>
                    <span>الاحكام</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('termsConditions.all')}}">
                            <i class="fa fa-circle"></i>
                            <span>شروط واحكام </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('privacyPolicy.all')}}">
                            <i class="fa fa-circle"></i>
                            <span> سياسة الخصوصية</span>
                        </a>
                    </li>
                    <li>
                            <a href="{{route('aboutUs.all')}}">
                                <i class="fa fa-circle"></i>
                                <span> عنا </span>
                            </a>
                    </li>
                </ul>
            </li>
          
            <li>
                <a class="sidebar-header" href="javascript:void(0)"><i
                        data-feather="settings"></i><span>الإعدادات</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('admin.show')}}"><i class="fa fa-circle"></i>بروفايل
                        </a>
                    </li>
                </ul>
            </li>
          
        </ul>
    </div>
</div>
