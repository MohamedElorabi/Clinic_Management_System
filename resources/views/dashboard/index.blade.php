@extends('dashboard.layouts.app')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card bg-analytics text-white">
        <div class="card-content">
            <div class="card-body text-center">
                
                <img src="{{asset('../dashboard/images/pages/index.jpg')}}" width="100%" height="655px" alt="">
                
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="fa fa-user-md text-warning font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700">{{ $reveals->count() }}</h2>
                    <p class="mb-0 line-ellipsis">عدد كشوفات اليوم</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card text-center">
            <div class="card-content">
                <div class="card-body">
                    <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                        <div class="avatar-content">
                            <i class="fas fa-hand-holding-usd text-warning font-medium-5"></i>
                            
                        </div>
                    </div>
                    <h2 class="text-bold-700">{{$reveals->sum('fees') + $reveals->sum('fees_other')}}</h2>
                    <p class="mb-0 line-ellipsis">إجمالى المبلغ</p>
                </div>
            </div>
        </div>
    </div>
</div>


<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
           <div class="card">
            @include('flash::message')
            <div class="card-header">
                <h4 class="card-title">عرض تقرير كشف اليوم</h4>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                            <table class="table zero-configuration dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">رقم الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">حالة الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">اسم المريض</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">موعد الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">الحلة المرضية</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">التشخيص</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">الأدوية</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">سعر الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">سعر أعمال إضافية</th>
                                    </tr>
                                </thead>
                                <tbody>                      
                                @foreach($reveals as $reveal)
                                <tr class="text-center">
                                    <th>{{$reveal->reveal_num}}</th>
                                    <td>{{$reveal->status}}</td>
                                    <td>{{$reveal->patient->name}}</td>
                                    <td>{{$reveal->detection_date}}</td>
                                    <td>{{$reveal->pathological_case}}</td>
                                    <td>{{$reveal->diagnosis}}</td>
                                    <td>{{$reveal->pharmaceutical}}</td>
                                    <td>{{$reveal->fees}}</td>
                                    <td>{{$reveal->fees_other}}</td>
                                   
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            
                            

        </div>
    </div>
</section>

@endsection