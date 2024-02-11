@extends('backend.layout.headerFooter')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>المباريات 
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
                        <li class="breadcrumb-item">المباريات</li>
                        <li class="breadcrumb-item active">عرض المباريات </li>
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
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> {{ Session::get('msg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-desi">
                            <table class="table all-package table-category" id="editableTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>التصنيف</th>
                                        <th>الفريق الأول</th>
                                        <th>الفريق الثاني</th>
                                        <th>النتيجة</th>
                                        <th>المكان</th>
                                        <th>الوقت والتاريخ</th>
                                        <th>حالة</th>
                                        <th>خيارات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @isset($FootballMatch)
                                        @foreach ($FootballMatch as $match)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td data-field="name">{{ $match->category->name ?: 'null' }}</td>
                                                <td data-field="slug">{{ $match->TeamF->name ?: 'null' }}</td>
                                                <td data-field="slug">{{ $match->TeamS->name ?: 'null' }}</td>
                                                <td data-field="slug">{{ $match->resultS ?: 0 }}-{{ $match->resultF ?: 0 }}</td>
                                                <td data-field="name">{{ $match->place }}</td>
                                                <td data-field="name">{{\Carbon\Carbon::parse($match->match_datetime)->format('Y-m-d\  TH:i')}}</td>
                                                <td class="order-cancle" data-field="status">
                                                    <span>
                                                        {{
                                                            $match->status == 'unstarted' ? 'لم يبدأ بعد' :
                                                            ($match->status == 'finished' ? 'انتهت' :
                                                            ($match->status == 'live' ? 'مباشر' : ''))
                                                        }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('FootballMatch.edit', $match->id) }}">
                                                        <i class="fa fa-edit" title="Edit"></i>
                                                    </a>

                                                    <a href="{{ route('FootballMatch.destroy', $match->id) }}">
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
