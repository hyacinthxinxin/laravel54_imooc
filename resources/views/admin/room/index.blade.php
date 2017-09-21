@extends('admin.layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">房间列表</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/rooms/create">增加房间</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>房间名称</th>
                                <th>房间描述</th>
                                <th>操作</th>
                            </tr>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>{{$room->id}}.</td>
                                    <td>{{$room->name}}</td>
                                    <td>{{$room->description}}</td>
                                    {{--<td>--}}
                                        {{--<a type="button" class="btn"--}}
                                           {{--href="/admin/roles/{{$role->id}}/permission">权限管理</a>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection