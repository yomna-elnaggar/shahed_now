@extends('backend.layout.headerFooter')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>تعديل الفريق
                                <small>لوحة التحكم</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('team.all')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item"> الفرق</li>
                            <li class="breadcrumb-item active">تعديل الفريق</li>
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
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('msg') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
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
                            <form action="{{ route('team.update', $team->id) }}" method="post" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>اسم
                                        الفريق</label>
                                    <div class="col-md-8">
                                        <input class="form-control" id="validationCustom1" type="text" name="name"
                                            required="" value="{{$team->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="validationCustom2" class="col-xl-3 col-md-4"><span>*</span>صورة</label>
                                    <div class="col-md-8">
                                        <input class="form-control" id="validationCustom2" type="file" name="logo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">Status</label>
                                    <div class="col-xl-9 col-md-8">
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox-primary-2" type="checkbox" data-original-title=""
                                                title=""name="status" {{$team->status == 'active'? 'checked' : ''}}>
                                            <label for="checkbox-primary-2">اظهار الفريق </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary d-block">حفظ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>


@endsection
