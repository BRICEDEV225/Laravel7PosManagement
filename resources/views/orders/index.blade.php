@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="float:left;">Order Products</h4>
                            <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal" data-target="#addUser">
                                <i class="fa fa-plus"></i> Add new Product
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Dis(%)</th>
                                        <th>Total</th>
                                        <!-- <th>Alert Stock</th>-->
                                        <th><a href="#" class="btn btn-sm btn-primary add_more rounded-circle"><i class="fa fa-plus-circle"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody class="addMoreProduct">
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="product_id[]" id="product_id" class="form-control product_id">
                                                <option value="">select item</option>
                                                @foreach ($products as $product)
                                                    <option data-price="{{$product->price}}" value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]" id="quantity" class="form-control quantity">
                                        </td>
                                        <td>
                                            <input type="number" name="price[]" id="price" class="form-control price">
                                        </td>
                                        <td>
                                            <input type="number" name="discount[]" id="discount" class="form-control discount">
                                        </td>
                                        <td>
                                            <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount">
                                        </td>
                                        <td><a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times-circle"></i></a></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header "><h4>Total <b class="total"> 0.00</b></h4></div>
                        <div class="card-body">
                            ---------
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal of adding new product --}}
    {{-- Modal
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
    </div>--}}
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
@section('script')
    <script>
       /* $(document).ready(function(){
            alert(1)
        })*/
        $('.add_more').on('click',function(){
            product = $('.product_id').html();
            numberofrow =($('.addMoreProduct tr').length - 0)+1;
            tr = '<tr><td class="no"">'+numberofrow+'</td>'+
                 '<td><select class="form-control product_id" name="product_id[]" id="product_id">'+product+
                 '</select></td>'+
                 '<td><input type="number" name="quantity[]" id="quantity" class="form-control quantity"></td>'+
                 '<td><input type="number" name="price[]" id="price" class="form-control price"></td>'+
                 '<td><input type="number" name="discount[]" id="discount" class="form-control discount"></td>'+
                 '<td><input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount"></td>'+
                 '<td><a href="#" class="btn btn-sm btn-danger delete"><i class="fa fa-times-circle"></i></a></td>';

            $('.addMoreProduct').append(tr);
            //Delete a row
            $('.addMoreProduct').delegate('.delete','click',function(){
                $(this).parent().parent().remove();
            })
        })
            function TotalAmount(){
                total = 0;
                $('.total_amount').each(function(i,e){
                    amount = $(this).val() - 0;
                    total += amount;
                })
                $('.total').html(total);
            }

            $('.addMoreProduct').delegate('.product_id','change',function(){
                tr = $(this).parent().parent();
                price = tr.find('.product_id option:selected').attr('data-price');
                tr.find('.price').val(price);
                qty = tr.find('.quantity').val()-0;
                disc = tr.find('.discount').val()-0;
                price = tr.find('.price').val()-0;
                total_amount = (qty * price) - ((qty * disc * price) / 100);
                tr.find('.total_amount').val(total_amount);
                TotalAmount();
            });

            $('.addMoreProduct').delegate('.quantity,.discount','keyup',function(){
                tr = $(this).parent().parent();
                qty = tr.find('.quantity').val()-0;
                disc = tr.find('.discount').val()-0;
                price = tr.find('.price').val()-0;
                total_amount = (qty * price) - ((qty * disc * price) / 100);
                tr.find('.total_amount').val(total_amount);
                TotalAmount();
            })
    </script>
@endsection
