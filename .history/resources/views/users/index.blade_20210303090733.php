@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="float:left;">Add user</h4>
                            <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal" data-target="#addUser">
                                <i class="fa fa-plus"></i> Add new users
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        {{-- <th>Phone</th> --}}
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            {{-- <td>{{$user->is_admin}}</td> --}}
                                            <td>
                                                @switch($user->is_admin)
                                                    @case(1)
                                                        Administrator
                                                        @break
                                                    @case(2)
                                                         Cashier
                                                        @break
                                                    @default

                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" data-toggle="modal" data-target="#editUser" class="btn btn-info btn-sm">
                                                        <i class="fa fa-edit">Edit</i>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#editUser" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash">Del</i>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#editUser" class="btn btn-info btn-sm">
                                                        <i class="fa fa-trash">Edit</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal of edditing user detail --}}
                                        {{-- Modal --}}
                                        <div class="modal right fade" id="editUser{{$user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Add user</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('user.update',$user->id)}}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="">Name</label>
                                                                <input type="text" name="name" id="" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Email</label>
                                                                <input type="email" name="email" id="" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Phone</label>
                                                                <input type="text" name="phone" id="" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Password</label>
                                                                <input type="password" name="password" id="" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Confirm Password</label>
                                                                <input type="password" name="confirm_password" id="" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Role</label>
                                                                <select name="is_admin" id="" class="form-control">
                                                                    <option value="1">Admin</option>
                                                                    <option value="2">Cashire</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary btn-block">Save user</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header"><h4>Search user</h4></div>
                        <div class="card-body">
                            ---------
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal of adding new user --}}
    {{-- Modal --}}
    <div class="modal right fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('user.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="is_admin" id="" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Cashire</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block">Save user</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal of edditing user detail --}}
    {{-- Modal --}}
    <div class="modal right fade" id="editUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('user.update',1)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="is_admin" id="" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Cashire</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block">Save user</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .modal.right .modal-dialog{
            /* position: absolute; */
            top:0;
            right:0;
            margin-right: 19vh;
        }
        .modal.fade:not(.in).right .modal.right{
            -webkit-transform: translate3d(25%,0.0);
            transform: translate3d(25%,0,0);
        }
    </style>
@endsection
