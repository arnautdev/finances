@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-4">
                <h3>Add to cart</h3>
                {{ Form::open(['route' => 'cart.store']) }}
                <div class="form-group">
                    <input type="text" class="form-control" name="productId" value="{{ time() }}"/>
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <select name="attributes[size]" class="form-control">
                        <option value="s">S</option>
                        <option value="xs">XS</option>
                        <option value="m">M</option>
                    </select>
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <select name="attributes[color]" class="form-control">
                        <option value="black">Black</option>
                        <option value="yellow">Yellow</option>
                        <option value="blue">Blue</option>
                    </select>
                </div><!-- End ./form-group -->

                {{ Form::submit('Add to cart') }}
                {{ Form::close() }}
            </div><!-- End ./col-4 -->

            <div class="col-8">
                Cart items
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Attributes</th>
                        <th>Actions</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Cart::getContent() as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                {{ $item->quantity }}
                                <a href="{{ route('cart.increment', ['id' => $item->id]) }}">+</a><br>
                                <a href="{{ route('cart.unIncrement', ['id' => $item->id]) }}">-</a>
                            </td>
                            <td>{{ $item->attributes }}</td>
                            <td>
                                <a href="{{ route('cart.remove', ['id' => $item->id]) }}" class="btn btn-danger">
                                    <i class="fa fa-trash-alt"></i>
                                </a>
                            </td>
                            <td>{{$item->getPriceSum()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- End ./row -->


    </div><!-- End ./container -->
@endsection
