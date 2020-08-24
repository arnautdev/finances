@extends('dashboard::layouts.master')

@section('content')

    {!! $form->panelStart([
        'title' => [
            'Show order: <b>:orderNumber</b>',
            ['orderNumber' => $data['order']->id]
        ]
    ]) !!}

    <div class="row">
        <div class="col-lg-6">
            {{ Form::open(['route' => ['orders.update', $data['order']->id]]) }}
            @method('PUT')
            <table class="table table-striped table-bordered">
                <tr>
                    <th colspan="2" class="text-right {{ $data['order']->getStatusClass() }}">{{ __('Order info') }}</th>
                </tr>
                <tr>
                    <th>{{ __('Status') }}</th>
                    <td class="col-lg-3">
                        {{ $data['order']->getStatusLabel() }}
                        <div class="pull-right">
                            <div class="input-group">
                                <select name="status" class="form-control no-radius no-border">
                                    @foreach($data['order']->getAvailableStatuses() as $key => $val)
                                        <option value="{{ $key }}"
                                                @if($data['order']->status == $key) selected="selected" @endif>{{ __($val) }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-light input-group-append no-radius">
                                    {{ __('Set status') }}
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Created At') }}</th>
                    <td>{{ $data['order']->created_at }}</td>
                </tr>
                <tr>
                    <th>{{ __('Order number') }}</th>
                    <td>{{ $data['order']->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('Amount') }}</th>
                    <td>
                        {{ $dashboard->intToFloat($data['order']->price) }}&nbsp;{{ $data['order']->currency }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Payment method') }}</th>
                    <td>
                        {{ $data['order']->getPaymentMethodLabel() }}
                    </td>
                </tr>
                @if($data['order']->additionalOrderInfo != '')
                    <tr>
                        <th>{{ __('Additional order info') }}</th>
                        <td>
                            {{ $data['order']->additionalOrderInfo }}
                        </td>
                    </tr>
                @endif

                <tr>
                    <th colspan="2" class="text-right">{{ __('Client info') }}</th>
                </tr>
                @php $client = $data['order']->getClient(); @endphp
                <tr>
                    <th>{{ __('Count orders') }}</th>
                    <td>{{ $client->getOrders()->count() }}</td>
                </tr>
                <tr>
                    <th>{{ __('Source') }}</th>
                    <td>{{ $client->socialSource }}</td>
                </tr>
                <tr>
                    <th>{{ __('Client name') }}</th>
                    <td>{{ $client->fullname() }}</td>
                </tr>
                <tr>
                    <th>{{ __('Phone') }}</th>
                    <td>{{ $client->phone }}</td>
                </tr>
                <tr>
                    <th>{{ __('Email') }}</th>
                    <td>{{ $client->email }}</td>
                </tr>
                <tr>
                    <th>{{ __('UserPersonalDataAgreement') }}</th>
                    <td>{{ $client->userPersonalDataAgreement }}</td>
                </tr>
                <tr>
                    <th>{{ __('UserMarketingDataAgreement') }}</th>
                    <td>{{ $client->userMarketingDataAgreement }}</td>
                </tr>

                <tr>
                    <th colspan="2" class="text-right">{{ __('Delivery info') }}</th>
                </tr>
                @php $address = $data['order']->getAddress(); @endphp
                <tr>
                    <th>{{ __('Country') }}</th>
                    <td>{{ $address->country }}</td>
                </tr>
                <tr>
                    <th>{{ __('City') }}</th>
                    <td>{{ $address->city }}</td>
                </tr>
                <tr>
                    <th>{{ __('Address') }}</th>
                    <td>{{ $address->address }}</td>
                </tr>

            </table>
            {{ Form::close() }}
        </div><!-- End ./col-lg-6 -->

        <div class="col-lg-6">
            <table class="table table-striped table-bordered">
                <tr>
                    <th colspan="4">{{ __('Order products') }}</th>
                </tr>

                <tr>
                    <th>{{ __('Product') }}</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Attributes') }}</th>
                </tr>

                @php $products = $data['order']->getProducts()->get(); @endphp
                @foreach($products as $orderItem)
                    @php $product = $orderItem->getProduct() @endphp
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $orderItem->qty }}</td>
                        <td>{{ $dashboard->intToFloat($orderItem->price) }}</td>
                        <td>{{ $orderItem->attributes }}</td>
                    </tr>
                @endforeach
            </table>
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./row -->

    {!! $form->panelEnd() !!}

@endsection
