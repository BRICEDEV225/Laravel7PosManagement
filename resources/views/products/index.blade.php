@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="float:left;">Add Products</h4>
                            <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal" data-target="#addUser">
                                <i class="fa fa-plus"></i> Add new Product
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Brand</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Sell price</th>
                                        <th>Alert Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->brand}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{number_format($product->price,2)}}</td>
                                            <td>
                                                @if ($product->alert_stock >= $product->quantity)
                                                    <span class="badge badge-danger">Low stock > {{$product->alert_stock}}</span>
                                                @else
                                                    <span class="badge badge-success">{{$product->alert_stock}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" data-toggle="modal" data-target="#editUser{{$product->id}}" class="btn btn-info btn-sm">
                                                        <i class="fa fa-edit">Edit</i>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteUser{{$product->id}}" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash">Del</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal of edditing user detail --}}
                                        {{-- Modal --}}
                                        <div class="modal right fade" id="editUser{{$product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Edit product Detail</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('products.update',$product->id)}}" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="form-group">
                                                                <label for="">Product</label>
                                                                <input type="text" name="product_name" id="" class="form-control" value="{{$product->product_name}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Description</label>
                                                                <textarea name="description" id="" cols="30" rows="2" class="form-control" >{{$product->description}}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Alert Stock</label>
                                                                <input type="number" name="alert_stock" id="" class="form-control" value="{{$product->alert_stock}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Price</label>
                                                                <input type="number" name="price" id="" class="form-control" value="{{$product->price}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Quantity</label>
                                                                <input type="number" name="quantity" id="" class="form-control" value="{{$product->quantity}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Brand</label>
                                                                <input type="text" name="brand" id="" class="form-control" value="{{$product->brand}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary btn-block">Update Product</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal of deleting product --}}
                                        {{-- Modal --}}
                                        <div class="modal right fade" id="deleteUser{{$product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Delete Product</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <p>Are you sure you want to delete this {{$product->product_name}} ?</p>

                                                            <div class="modal-footer">
                                                                <button class="btn btn-info" data-dismiss="modal">Cancel </button>
                                                                <button type="submit" class="btn btn-danger" >Delete </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                                {{$products->links()}}
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
    {{--Modal of adding new product --}}
    {{-- Modal --}}
    <div class="modal right fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('products.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Product</label>
                            <input type="text" name="product_name" id="" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="">Brand</label>
                            <input type="text" name="brand" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Alert Stock</label>
                            <input type="number" name="alert_stock" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="price" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="number" name="quantity" id="" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal of edditing user detail --}}
    {{-- Modal --}}
   {{--  <div class="modal right fade" id="editUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Edit Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('products.update',1)}}" method="post">
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
    </div> --}}
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
