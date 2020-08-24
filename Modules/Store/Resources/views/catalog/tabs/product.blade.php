<div class="form-horizontal form-bordered">

    {{ Form::open(['route' => ['catalog.update', $data['product']->id], 'data-parsley-validate' => true, 'enctype' => 'multipart/form-data']) }}
    @if(isset($data['product']))
        @method('PUT')
    @endif

    <div class="panel-heading border-bottom bg-light">
        <h3 class="panel-title">{{ __('Base product info') }}</h3>
    </div>

    {!! $form->buttons() !!}

    {!! $form->isActive([
        'label' => 'Is active',
        'name' => 'isActive',
        'data' => $data,
        'model' => 'product',
    ]) !!}

    {!! $form->input([
        'label' => 'Title',
        'name' => 'title',
        'model'=>'product',
        'data' => $data,
        'attrs' => [
            'required' => 'required'
        ],
    ]) !!}

    <div class="form-group row">
        <label class="col-md-3 col-form-label text-right">{{ __('Price settings') }}</label>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-4">
                    <small class="text-secondary">{{ __('product price') }}</small>
                    {!! $form->amount([
                        'label' => 'Price',
                        'name' => 'price',
                        'onlyInput' => true,
                        'model'=>'product',
                        'data' => $data,
                        'attrs' => [
                            'required' => 'required',
                            'placeholder' => 'Product price 0.00',
                        ],
                    ]) !!}
                </div><!-- End ./col-lg-4 -->
                <div class="col-lg-4">
                    <small class="text-secondary">{{ __('promo price') }}</small>
                    {!! $form->amount([
                        'label' => 'Promo price',
                        'name' => 'promoPrice',
                        'onlyInput' => true,
                        'model'=>'product',
                        'data' => $data,
                        'attrs' => [
                            'required' => 'required',
                            'placeholder' => 'Promo price 0.00',
                        ],
                    ]) !!}
                </div><!-- End ./col-lg-4 -->
                <div class="col-lg-4">
                    <small class="text-secondary">{{ __('getting price') }}</small>
                    {!! $form->amount([
                        'label' => 'Getting price',
                        'name' => 'gettingPrice',
                        'onlyInput' => true,
                        'model'=>'product',
                        'data' => $data,
                        'attrs' => [
                            'placeholder' => 'Getting price 0.00',
                        ],
                    ]) !!}
                </div><!-- End ./col-lg-4 -->
            </div><!-- End ./row -->
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->


    {!! $form->textarea([
        'label' => 'Short description',
        'name' => 'description',
        'class' => 'redactor',
        'model'=>'product',
        'data' => $data,
        'attrs' => [],
    ]) !!}

    {!! $form->textarea([
        'label' => 'Full description',
        'name' => 'content',
        'class' => 'redactor',
        'model'=>'product',
        'data' => $data,
        'attrs' => [],
    ]) !!}

    <div class="panel-heading border-bottom bg-light">
        <h3 class="panel-title">{{ __('Multimedia') }}</h3>
    </div>

    {!! $form->attachments(['model' => 'product', 'data' => $data]) !!}


    <div class="panel-heading border-bottom bg-light">
        <h3 class="panel-title">{{ __('Additional product info') }}</h3>
    </div>

    <div class="form-group row">
        <label class="col-lg-3 col-form-label text-right">
            {{ __('Main product category') }}<br>
            [+ <a href="#create-category" data-toggle="modal">{{ __('Add new category') }}</a>]
        </label>
        <div class="col-lg-6">
            {!! $form->select([
                'onlyInput' => true,
                'name' => 'categoryId',
                'class' => 'no-radius',
                'options' => $data['categories'],
                'emptyOption' => [-1, 'Select category'],
                'model'=>'product',
                'data' => $data,
            ]) !!}
        </div><!-- End ./col-lg -->
    </div><!-- End ./form-group -->


    <div class="form-group row">
        <label class="col-lg-3 col-form-label text-right">
            {{ __('Also show in this categories') }}
        </label>
        <div class="col-lg-6">
            {!! $form->select([
                'onlyInput' => true,
                'name' => 'categoryIds[]',
                'class' => 'no-radius multiple-select2',
                'attrs' => [
                    'multiple' => 'multiple',
                    'data-placeholder' => 'Select additional product categories'
                ],
                'options' => $data['categories'],
                'selectedArray' => ((isset($data['relProductCategories'])) ? $data['relProductCategories'] : [])
            ]) !!}
        </div><!-- End ./col-lg -->
    </div><!-- End ./form-group -->


    {!! $form->input([
        'label' => 'Catalog number',
        'name' => 'catalogNumber',
        'model'=>'product',
        'data' => $data,
        'attrs' => [
            'placeholder' => 'Will be generate automatic'
        ]
    ]) !!}

    <div class="form-group row">
        <label class="col-lg-3 col-form-label text-right">
            {{ __('Author (brand)') }}<br>
            [+ <a href="#create-author" data-toggle="modal">{{ __('Add new brand') }}</a>]
        </label>
        <div class="col-lg-6">
            {!! $form->select([
                'onlyInput' => true,
                'name' => 'brandId',
                'class' => 'no-radius',
                'emptyOption' => [-1, 'Select brand'],
                'options' => $data['brands'],
                'model'=>'product',
                'data' => $data,
            ]) !!}
        </div><!-- End ./col-lg -->
    </div><!-- End ./form-group -->

    {{--    <div class="panel-heading border-bottom bg-light">--}}
    {{--        <h3 class="panel-title">{{ __('Product variant and varieties') }}</h3>--}}
    {{--    </div>--}}

    {{--    <div class="form-group row">--}}
    {{--        <label class="col-md-3 col-form-label text-right">{{ __('Product params') }}</label>--}}
    {{--        <div class="col-lg-6">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-4">--}}
    {{--                    {!! $form->input([--}}
    {{--                        'label' => 'Label',--}}
    {{--                        'name' => 'productVariant[label]',--}}
    {{--                        'onlyInput' => true,--}}
    {{--                        'attrs' => [--}}

    {{--                        ],--}}
    {{--                    ]) !!}--}}
    {{--                </div><!-- End ./col-lg-4 -->--}}
    {{--                <div class="col-lg-8">--}}
    {{--                    {!! $form->tagIt([--}}
    {{--                        'name' => 'productVariant[params]',--}}
    {{--                        'onlyInput' => true--}}
    {{--                    ]) !!}--}}
    {{--                </div><!-- End ./col-lg-8 -->--}}
    {{--            </div><!-- End ./row -->--}}
    {{--        </div><!-- End ./col-lg-6 -->--}}
    {{--    </div><!-- End ./form-group -->--}}


    <div class="panel-heading border-bottom bg-light">
        <h3 class="panel-title">{{ __('Related products') }}</h3>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label text-right">
            {{ __('Select related products') }}
        </label>
        <div class="col-lg-6">
            {!! $form->select([
                'onlyInput' => true,
                'name' => 'relatedProducts[]',
                'class' => 'no-radius multiple-select2',
                'attrs' => [
                    'multiple' => 'multiple',
                    'data-placeholder' => 'Select related products'
                ],
                'options' => $data['relProducts'],
                'selectedArray' => $data['relProductIds']
            ]) !!}
        </div><!-- End ./col-lg -->
    </div><!-- End ./form-group -->


    <div class="panel-heading border-bottom bg-light">
        <h3 class="panel-title">{{ __('SEO optimization') }}</h3>
    </div>

    {!! $form->input([
        'label' => 'Meta title',
        'name' => 'meta_title',
        'model' => 'seo',
        'data' => $data,
    ]) !!}

    {!! $form->input([
        'label' => 'Meta keywords',
        'name' => 'meta_keywords',
        'model' => 'seo',
        'data' => $data,
    ]) !!}

    {!! $form->textarea([
        'label' => 'Meta description',
        'name' => 'meta_description',
        'model' => 'seo',
        'data' => $data,
    ]) !!}

    {!! $form->file([
        'label' => 'Og Image',
        'name' => 'ogImage',
        'class' => 'btn-block',
        'model' => 'seo',
        'data' => $data,
    ]) !!}

    {!! $form->buttons() !!}

    {{ Form::close() }}
</div><!-- End ./form-horizontal -->


{!! $form->modal('create-category', $data) !!}
{!! $form->modal('create-author') !!}
