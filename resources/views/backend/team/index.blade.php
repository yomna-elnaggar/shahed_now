@extends('backend.layout.headerFooter')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3> الفرق
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
                            <li class="breadcrumb-item">الفرق</li>
                            <li class="breadcrumb-item active"> عرض الفرق</li>
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
                    <div class="card">
                        <div class="card-header">
                            <form class="form-inline search-form search-box">
                                {{-- <div class="form-group">
                                <input class="form-control-plaintext" type="search" placeholder="Search..">
                            </div> --}}
                            </form>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> {{ Session::get('msg') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                           
                            {{-- <a href="{{ route('package.create') }}" class="btn btn-primary add-row mt-md-0 mt-2">اضافة
                                التصنيف</a> --}}
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-desi">
                                <table class="table all-package table-category " id="editableTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم</th>
                                            <th>الصورة</th>
                                            <th>حالة</th>
                                            <th>خيارات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @isset($team)
                                            @foreach ($team as $item)
                                                <tr>
                                                    <td>{{$loop->iteration }}</td>
                                                    <td data-field="name">{{$item->name}}</td>
                                                    <td data-field="slug"><img src="{{asset('upload/Team/'.$item->logo)}}"></td>

                                                    <td class="order-cancle" data-field="status">
                                                        <span>{{$item->status == 'active'? 'active' : 'inactive'}}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('team.edit' , $item->id)}}">
                                                            <i class="fa fa-edit" title="Edit"></i>
                                                        </a>

                                                        <a href="{{route('team.destroy', $item->id)}}">
                                                            <i class="fa fa-trash" title="Delete"></i>
                                                        </a>
                                                    </td>
                                                </tr>
           
                                            @endforeach
                                        @endisset


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>




@endsection
