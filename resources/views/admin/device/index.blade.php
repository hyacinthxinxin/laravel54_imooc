@extends('admin.layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">设备列表</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/devices/create">增加设备</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>设备名称</th>
                                <th>设备描述</th>
                                <th>操作</th>
                            </tr>
                            @foreach($devices as $device)
                                <tr>
                                    <td>{{$device->id}}.</td>
                                    <td>{{$device->name}}</td>
                                    <td>{{$device->description}}</td>
                                    {{--<td>--}}
                                        {{--<a type="button" class="btn"--}}
                                           {{--href="/admin/roles/{{$role->id}}/permission">权限管理</a>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $devices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection