@extends('backend.layout.headerFooter')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>لوحة التحكم
                            <small>لوحة إدارة  شاهد الان</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">لوحة التحكم</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="warning-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="navigation" class="font-warning"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">مكتسبات</span>
                                <h3 class="mb-0">$ <span class="counter">6659</span><small> هذا
                                        شهر</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="secondary-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="box" class="font-secondary"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">الفرق</span>
                                <h3 class="mb-0"><span class="counter">{{$teams}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="primary-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center"><i data-feather="message-square"
                                        class="font-primary"></i></div>
                            </div>
                            <div class="media-body media-doller"><span class="m-0">رسائل</span>
                                <h3 class="mb-0"> <span class="counter">{{$contact_us}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="danger-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center"><i data-feather="users"
                                        class="font-danger"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller"><span class="m-0"> المستخدمين</span>
                                <h3 class="mb-0"><span class="counter">{{$users}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
