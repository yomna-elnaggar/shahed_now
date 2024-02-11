@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>تعديل  الادمن
                                <small>لوحة التحكم</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item">الادمن</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li class="text-danger">
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update', $admin->id) }}" method="POST"
                                class="needs-validation">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>name</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $admin->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>email</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $admin->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>password</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="password" name="password" minlength="8"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>Confirm Password</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="password" name="password_confirmation"
                                            minlength="8" autocomplete="off">
                                    </div>
                                </div>
                                <button type="submit" class="btn d-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>


@endsection


<style>
    #category,
    #subcategory {
        color: #2b2b2b;
    }

    .dark option {
        background-color: #FFF !important;
    }
</style>
