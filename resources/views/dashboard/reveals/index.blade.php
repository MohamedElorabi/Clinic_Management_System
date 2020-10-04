@extends('dashboard.layouts.app')

@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
           <div class="card">
            @include('flash::message')
            <div class="card-header">
                <h4 class="card-title">عرض قائمة الكشف</h4>
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
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">انتهى</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">حالة الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">اسم المريض</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">موعد الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">تكلفة الكشف</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">تكاليف أخرى</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">عرض</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Edit: activate to sort column ascending">تعديل</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Delete: activate to sort column ascending">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>                      
                                @foreach($reveals as $reveal)
                                <tr class="text-center">
                                    <th>{{$reveal->reveal_num}}</th>
                                    <th><a  class="btn btn-success"  href="{{url(route('reveals.finished',$reveal->id)) }}" > انتهى</a></th>
                                    <td>{{$reveal->status}}</td>
                                    <td>{{$reveal->patient->name}}</td>
                                    <td>{{$reveal->detection_date}}</td>
                                    <td>{{$reveal->fees}}</td>
                                    <td>{{$reveal->fees_other}}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('read-reveals'))
                                            <a href="{{url(route('reveals.show', $reveal->id))}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        @else
                                        <button type="submit" class="btn btn-success btn-xs disabled"><i class="fa fa-primary"></i></button>
                                        @endif
                                    </td>
                                    <td>
                                    @if (auth()->user()->hasPermission('update-reveals'))
                                        <a href="{{url(route('reveals.edit', $reveal->id))}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @else
                                    <button type="submit" class="btn btn-success btn-xs disabled"><i class="fa fa-edit"></i></button>
                                    @endif
                                    </td>
                                    <td>
                                    @if (auth()->user()->hasPermission('delete-reveals'))
                                    <form method="post" action="{{route('reveals.destroy', $reveal->id)}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                    @else
                                    <button type="submit" class="btn btn-danger btn-xs disabled"><i class="fa fa-trash-o"></i></button>
                                    @endif
                                    </td>
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



