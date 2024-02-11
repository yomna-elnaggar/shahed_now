@extends('backend.layout.headerFooter')
@section('content')

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>انشاء الدوريات
                                <small>لوحة التحكم</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('category.all')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item"> الدوريات</li>
                            <li class="breadcrumb-item active">عرض الدوريات </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

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
                            <form action="{{ route('category.store') }}" method="post" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                <div id="inputFieldsContainer">
                                    <div class="form-group row">
                                        <label for="validationCustom1" class="col-xl-2 col-md-4"><span>*</span>اسم الدوري</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="names[]" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="button" class="btn btn-success" onclick="addInputField()">إضافة دوري جديد</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addInputField() {
            var container = document.getElementById('inputFieldsContainer');
            var newInputField = document.createElement('div');
            newInputField.className = 'form-group row';
            newInputField.innerHTML = `
                <label for="validationCustom1" class="col-xl-2 col-md-4"><span>*</span>اسم الدوري</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" name="names[]" required="">
                </div>`;
            container.appendChild(newInputField);
        }
    </script>

@endsection
