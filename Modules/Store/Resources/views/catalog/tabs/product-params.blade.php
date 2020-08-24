<div class="form-horizontal form-bordered">

    {{ Form::open(['route' => ['product-params.store', 'referer' => true], 'data-parsley-validate' => true, 'enctype' => 'multipart/form-data']) }}
    @if(isset($data['product']))
        <input type="hidden" name="productId" value="{{ $data['product']->id }}">
    @endif

    <div class="panel-heading border-bottom bg-light">
        <h3 class="panel-title">{{ __('Base product info') }}</h3>
    </div>

    {!! $form->buttons() !!}

    {!! $form->input([
            'label' => 'Title',
            'name' => 'title',
            'attrs' => [
                'required' => 'required'
            ]
        ]) !!}

    {!! $form->tagIt([
        'label' => 'Options',
        'name' => 'options',
        'attrs' => [
            'required' => 'required'
        ]
    ]) !!}


    {!! $form->buttons() !!}

    {{ Form::close() }}

    <div class="panel-heading border-bottom bg-light">
        <h3 class="panel-title">{{ __('Added params') }}</h3>
    </div>

    <div class="form-group row">
        <label for="" class="col-md-3 col-form-label text-right">{{ __('Product params') }}</label>
        <div class="col-lg-6">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Options') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data['product']->getProductParams()->get() as $productParam)
                    <tr>
                        <td>{{ $productParam->title }}</td>
                        <td>{{ $productParam->options }}</td>
                        <td>
                            {{ Form::open(['route' => ['product-params.destroy', $productParam->id]]) }}
                            @method('DELETE')

                            <a href="{{ route('product-params.edit', $productParam->id) }}"
                               class="btn btn-xs btn-primary no-radius">
                                <i class="fa fa-edit"></i>&nbsp;{{ __('Edit') }}
                            </a>

                            <button type="submit" class="btn btn-xs btn-danger no-radius">
                                <i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}
                            </button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->

    <div class="panel-heading border-bottom bg-light">
        <h3 class="panel-title">{{ __('Available options') }}</h3>
    </div>

    {{ Form::open(['route' => 'product-options.store', 'data-parsley-validate' => true]) }}
    <input type="hidden" name="productId" value="{{ $data['product']->id }}"/>
    <div class="form-group row">
        <label for="" class="col-md-3 col-form-label text-right">{{ __('Product options') }}</label>
        <div class="col-lg-6">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Option') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Available') }}</th>
{{--                    <th>{{ __('Actions') }}</th>--}}
                </tr>
                </thead>

                <tbody>
                @foreach($data['product']->generateProductOptions() as $productOption)
                    <input type="hidden" name="productOptions[{{ $productOption->optionKey }}][optionKey]"
                           value="{{ $productOption->optionKey }}"/>
                    <input type="hidden" name="productOptions[{{ $productOption->optionKey }}][optionLabel]"
                           value="{{ $productOption->optionLabel }}"/>
                    @if($productOption->exists)
                        <input type="hidden" name="productOptions[{{ $productOption->optionKey }}][id]"
                               value="{{ $productOption->id }}"/>
                    @endif

                    <tr>
                        <td>{{ $productOption->optionLabel }}</td>
                        <td>
                            <input type="text"
                                   name="productOptions[{{ $productOption->optionKey }}][price]"
                                   class="form-control"
                                   @if($productOption->exists)
                                   value="{{ $dashboard->intToFloat($productOption->price) }}"
                                   @else
                                   value="{{ $dashboard->intToFloat($data['product']->getPrice()) }}"
                                @endif
                            />
                        </td>
                        <td>
                            <input type="text"
                                   name="productOptions[{{ $productOption->optionKey }}][availableCount]"
                                   class="form-control"
                                   value="{{ $productOption->availableCount ?? 0 }}"
                            />
                        </td>
{{--                        <td>--}}
{{--                            {{ Form::open(['route' => ['product-options.destroy', $productOption->id]]) }}--}}
{{--                            @method('DELETE')--}}

{{--                            <a href="{{ route('product-params.edit', $productParam->id) }}"--}}
{{--                               class="btn btn-xs btn-primary no-radius">--}}
{{--                                <i class="fa fa-edit"></i>&nbsp;{{ __('Edit') }}--}}
{{--                            </a>--}}

{{--                            <button type="submit" class="btn btn-xs btn-danger no-radius">--}}
{{--                                <i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}--}}
{{--                            </button>--}}
{{--                            {{ Form::close() }}--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->

    {!! $form->buttons() !!}
    {{ Form::close() }}

</div><!-- End ./form-horizontal -->

