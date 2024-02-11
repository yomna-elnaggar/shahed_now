@extends('backend.layout.headerFooter')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>تعديل مباراة
                            <small>لوحة التحكم</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('FootballMatch.all')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item"> المباريات</li>
                        <li class="breadcrumb-item active">تعديل مباراة</li>
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
                        <form action="{{ route('FootballMatch.update', $FootballMatch->id) }}" method="post" class="needs-validation" enctype="multipart/form-data">
                            @csrf
               
                            <div class="form-group row">
                                <label for="validationCustom2" class="col-xl-2 col-md-4"><span>*</span> التصنيف العام </label>
                                <div class="col-md-4">
                                    <select class="form-select" aria-label="Disabled select example" name="category_id">
                                        <option selected>اختر الدوري</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}" {{ $FootballMatch->category_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom2" class="col-xl-2 col-md-4"><span>*</span>  الفريق الأول </label>
                                <div class="col-md-3">
                                    <select class="form-select" aria-label="Disabled select example" name="teamF_id">
                                        <option selected>اختر الفريق الأول</option>
                                        @foreach ($teams as $item)
                                            <option value="{{$item->id}}" {{ $FootballMatch->teamF_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="validationCustom2" class="col-xl-2 col-md-2 text-md-end"><span>*</span>  نتيجة الفريق الأول </label>
                                <div class="col-md-2">
                                    <select class="form-select" aria-label="Disabled select example" name="resultF">
                                        @for ($i = 0; $i <= 15; $i++)
                                            <option value="{{ $i }}" {{ $FootballMatch->resultF == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom2" class="col-xl-2 col-md-4"><span>*</span>  الفريق الثاني </label>
                                <div class="col-md-3">
                                    <select class="form-select" aria-label="Disabled select example" name="teamS_id">
                                        <option selected>اختر الفريق الثاني</option>
                                        @foreach ($teams as $item)
                                            <option value="{{$item->id}}" {{ $FootballMatch->teamS_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="validationCustom2" class="col-xl-2 col-md-2 text-md-end"><span>*</span>  نتيجة الفريق الثاني </label>
                                <div class="col-md-2">
                                    <select class="form-select" aria-label="Disabled select example" name="resultS">
                                        @for ($i = 0; $i <= 15; $i++)
                                            <option value="{{ $i }}" {{ $FootballMatch->resultS == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom1" class="col-xl-2 col-md-4"><span>*</span>المكان</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="validationCustom1" type="text" name="place" value="{{ $FootballMatch->place }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-2 col-md-4">حالة المباراة</label>
                                <div class="col-xl-9 col-md-8">
                                    <select class="form-select" name="status">
                                        <option value="unstarted" {{ $FootballMatch->status == 'unstarted' ? 'selected' : '' }}>لم يبدأ بعد</option>
                                        <option value="live" {{ $FootballMatch->status == 'live' ? 'selected' : '' }}>مباشر</option>
                                        <option value="finished" {{ $FootballMatch->status == 'finished' ? 'selected' : '' }}>انتهت</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom1" class="col-xl-2 col-md-4"><span>*</span>رابط المباراة المباشرة</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="validationCustom1" type="text" name="live" value="{{ $FootballMatch->live }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="validationCustom1" class="col-xl-2 col-md-4"><span>*</span>تاريخ ووقت المباراة</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="validationCustom1" type="datetime-local" name="match_datetime" value="{{ \Carbon\Carbon::parse($FootballMatch->match_datetime)->format('Y-m-d\TH:i') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-block">حفظ التعديلات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@endsection
