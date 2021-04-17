@extends('common.layout')
@section('title','用户管理')
@section('content')
        <h2>用户列表</h2>
        <p class="text-left"><a class="btn btn-success" href="/adm/user/add-user">添加管理员</a>
        <table class="table table-dark">

                <tr>

                    <td width="15%">id</td>
                    <td width="20%">用户名</td>
                    <td width="20%">邮箱</td>
                    <td width="20%">更新时间</td>
                    <td width="16%">管理</td>
                </tr>
                <tbody>
                @foreach ($users as $v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->username}}</td>
                        <td>{{$v->email}}</td>
                        <td>{{$v->created_at}}</td>
                        <td>
                            <a class="btn btn-warning" href="/adm/user/edit-user/{{$v->id}}">编辑密码</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    <div class="float-right">
        {{$users->links()}}
    </div>
@endsection