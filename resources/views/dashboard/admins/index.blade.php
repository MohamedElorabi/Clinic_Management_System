@extends('dashboard.layouts.app')

@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
           <div class="card">
            @include('flash::message')
            <div class="card-header">
                <h4 class="card-title">عرض الأدمن</h4>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                            <table class="table zero-configuration dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending"> #الرقم</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">الاسم</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">الأدوار</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Edit: activate to sort column ascending">تعديل</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Delete: activate to sort column ascending">حذف</th>
                                    </tr>
                                </thead>
                                <tbody>                      
                                @foreach($users as $user)
                                <tr class="text-center">
                                    <th>{{$user->id}}</th>
                                    <td>{{$user->user_name}}</td>
                                    <td>
                                      <div class="btn btn-bitbucket">
                                      @foreach($user->roles()->get() as $role)
                                        {{ $role->display_name}}
                                      @endforeach
                                      </div> 
                                    </td>

                                    <td>
                                    @if (auth()->user()->hasPermission('update-users'))
                                        <a href="{{url(route('admins.edit', $user->id))}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    </td>
                                    @else
                                    <button type="submit" class="btn btn-success btn-xs disabled"><i class="fa fa-edit"></i></button>
                                    @endif
                                    <td>
                                    @if (auth()->user()->hasPermission('delete-users'))
                                    <form method="post" action="{{route('admins.destroy',$user->id)}}">
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

