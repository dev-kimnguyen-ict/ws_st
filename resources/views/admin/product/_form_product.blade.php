@section('head.scripts')
    <script src="{{ asset('contents/ckeditor/ckeditor.js') }}"></script>
@endsection

<div class="formRow">
    <label for="seo_title" style="font-weight: bold; font-size: 16px;" class="textC">Thêm thông tin sản phẩm</label>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('name', 'Tên sản phẩm:') !!}
    <div class="formRight">
        <div class="oneTwo">
            {!! Form::text(
                'name',
                isset($product->name) ? $product->name : null,
                [
                    'required' => 'true',
                    'placeholder' => 'Nhập tên sản phẩm',
                ]
            ) !!}
            <div class="clear error" name="name_error">
                @if ($errors->has('name'))
                    <strong>{{ $errors->first('name') }}</strong>
                @endif
            </div>
        </div>
        <div class="oneTwo">
            <select name="category_id" style="margin: auto 45px;" class="select-category textC">
                <option style="font-weight: bold;">--- Chọn danh mục sản phẩm ---</option>
                @foreach($categories as $category)
                    <option
                        @if(isset($product) && $product->category_id === $category->getKey())
                        selected="selected"
                        @endif
                        value="{{$category->getKey()}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
            <div class="clear error" name="name_error">
                @if ($errors->has('category_id'))
                    <strong>{{ $errors->first('category_id') }}</strong>
                @endif
            </div>
            <a href="{{ route('admin.category.create') }}" style="position: absolute; right: 15px; top: 36%;">
                Tạo danhmục
            </a>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('price', 'Giá bán:') !!}
    <div class="formRight">
        <div class="oneTwo">
            {!! Form::hidden('price', isset($product->price) ? $product->price : null) !!}

            {!! Form::text('price', isset($product->price) ? $product->price : null, [
                    'placeholder' => 'Nhập giá bán cho sản phẩm',
                    'class' => 'input-fix accounting'
                ])
            !!}
            <div class="clear error" name="name_error">
                @if ($errors->has('price'))
                    <strong>{{ $errors->first('price') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('discount', 'Giảm giá (%):') !!}
    <div class="formRight">
        <div class="oneTwo">
            {!! Form::number(
                'discount',
                isset($product->discount) ? $product->discount : null,
                [
                    'placeholder' => 'Nhập phần trăm giảm giá',
                    'min' => 0,
                    'class' => 'input-fix',
                ]
            ) !!}
            <div class="clear error" name="name_error">
                @if ($errors->has('discount'))
                    <strong>{{ $errors->first('discount') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('active', 'Trạng thái:') !!}
    <div class="formRight">
        <div class="oneTwo">
            <div class="radiobox">
                <input
                    id="hien_thi"
                    type="radio"
                    name="active"
                    @if((isset($product) && $product->status == true) || !isset($product->status))
                    checked="true"
                    @endif
                    value="1"
                />
                {!! Form::label('hien_thi', 'Hiển thị') !!}
            </div>
            <div class="radiobox">
                <input
                    id="an"
                    type="radio"
                    name="active"
                    @if(isset($product) && $product->status == false)
                    checked="true"
                    @endif
                    value="0"
                />
                {!! Form::label('an', 'Ẩn') !!}
            </div>
            <div class="clear error" name="name_error">
                @if ($errors->has('active'))
                    <strong>{{ $errors->first('active') }}</strong>
                @endif
            </div>
        </div>
        <div class="oneTwo">
            {!! Form::select('mark', [
                    '0' => '--- Không đánh dấu sản phẩm ---',
                    '1' => 'Đánh dấu là sản phẩm mới',
                    '2' => 'Đánh dấu là sản phẩm nổi bật'
                ], isset($product) ? $product->mark : '0', ['class' => 'textC', 'style' => 'margin: auto 45px;'])
            !!}
            <div class="clear error" name="name_error">
                @if ($errors->has('mark'))
                    <strong>{{ $errors->first('mark') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('content', 'Nội dung bài viết:') !!}
    <div class="formRight">
        <div class="">
            {!! Form::textarea('content', isset($product->longdesc) ? $product->longdesc : null) !!}
            <div class="clear error" name="name_error">
                @if ($errors->has('content'))
                    <strong>{{ $errors->first('content') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
@php $hasDescription = $product->description ?? null @endphp

@if(!$hasDescription)
    <div class="formRow">
        <div class="formRight">
            <a id="adddesc" href="javascript:void(0)">Thêm mô tả ngắn</a>
        </div>
        <div class="clear"></div>
    </div>
@endif

<div class="formRow" id="container_description" @if(!$hasDescription) style="display: none;" @endif>
    {!! Form::label('description', 'Mô tả ngắn:') !!}
    <div class="formRight">
        <div class="">
            {!! Form::textarea('description', isset($product) && $product->shortdesc != null ? $product->shortdesc : null) !!}
            <div class="clear error" name="name_error">
                @if ($errors->has('description'))
                    <strong>{{ $errors->first('description') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow">
    <label for="seo_title" style="font-weight: bold; font-size: 16px;" class="textC">Thêm hình ảnh sản phẩm</label>
    <div class="clear"></div>
</div>

<div class="formRow">
    <div id="uploader" class="uploader">
        @include('admin.product._upload_form')
    </div>
</div>

<div class="formRow">
    <label for="seo_title" style="font-weight: bold; font-size: 16px;" class="textC">Tối ưu SEO</label>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('seo_title', 'Thẻ tiêu đề:') !!}
    <div class="formRight">
        <div class="oneTwo">
            <div class="input-helper">
                {!! Form::text(
                    'seo_title',
                    isset($product) && $product->seo->title != null ? $product->seo->title : null,
                    ['required' => true, 'size' => '70']
                )!!}
                <div class="input-length" id="seo_title_length">0/70</div>
            </div>
            <div class="clear error" name="name_error">
                @if ($errors->has('seo_title'))
                    <strong>{{ $errors->first('seo_title') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('seo_description', 'Thẻ mô tả:') !!}
    <div class="formRight">
        <div class="oneTwo">
            <div class="input-helper">
                {!! Form::text(
                    'seo_description',
                    isset($product) && $product->seo->desc != null ? $product->seo->desc : null,
                    ['max' => 160]
                ) !!}
                <div class="input-length" id="seo_description_length">0/160</div>
            </div>
            <div class="clear error" name="name_error">
                @if ($errors->has('seo_description'))
                    <strong>{{ $errors->first('seo_description') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('seo_alias', 'Đường dẫn / Bí danh (Alias):') !!}
    <div class="formRight">
        <div class="oneTwo">
            {!! Form::text(
                'seo_alias',
                isset($product) && $product->seo->alias != null ? $product->seo->alias : null,
                ['required' => true]
            ) !!}
            <div class="clear error" name="name_error">
                @if ($errors->has('seo_alias'))
                    <strong>{{ $errors->first('seo_alias') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<script>
    var tieuDeSize = 70,
        moTaSize = 160,
        subfix_tieude = '/' + tieuDeSize,
        subfix_mota = '/' + moTaSize,
        txtTenSP = $('#name'),
        seoMoTa = $('#seo_description'),
        seoMoTaLength = $('#seo_description_length'),
        seoTieuDe = $('#seo_title'),
        seoTieuDeLength = $('#seo_title_length'),
        seoAlias = $('#seo_alias');
    CKEDITOR.replace('description');
    CKEDITOR.replace('content');

    function fixCurrency (e) {
        var temp = e.val().replace(/\D/g, '');
        e.prev('input').val(temp);
        var n = temp != '' ? parseInt(temp, 10) : '';
        e.val(n.toLocaleString());
    }

    $('#adddesc').click(function () {
        $(this).parent('div').parent('div').remove();
        $('#container_description').show();
    });

    $(function () {
        seoMoTaLength.html(seoMoTa.val().length + subfix_mota);
        fixCurrency($('#price'));
    });

    function processTenSPChange (value) {
        processSeoTieuDe(value, true);
        seoAlias.val(changeToSlug(value));
    }
    function processSeoTieuDe (value, exception) {
        if (value.length > tieuDeSize) {
            seoTieuDeLength.html(tieuDeSize + subfix_tieude);
            seoTieuDe.val(value.slice(0, tieuDeSize));
        } else {
            if (exception) seoTieuDe.val(value);
            seoTieuDeLength.html(value.length + subfix_tieude);
        }
    }

    function processSeoMoTa (value) {
        if (value.length > moTaSize) {
            seoMoTaLength.html(moTaSize + subfix_mota);
            seoMoTa.val(value.slice(0, moTaSize));
        } else {
            seoMoTaLength.html(value.length + subfix_mota);
        }
    }

    txtTenSP.keyup(function (e) {
        processTenSPChange(e.target.value);
    });
    txtTenSP.change(function (e) {
        processTenSPChange(e.target.value);
    });
    seoTieuDe.keyup(function (e) {
        processSeoTieuDe(e.target.value, false);
    });
    seoTieuDe.change(function (e) {
        processSeoTieuDe(e.target.value, false);
    });
    seoMoTa.keyup(function (e) {
        processSeoMoTa(e.target.value);
    });
    seoMoTa.change(function (e) {
        processSeoMoTa(e.target.value);
    });
    $('.accounting').keyup(function (e) {
        fixCurrency($(this));
    });
    $('.accounting').change(function (e) {
        fixCurrency($(this));
    });
</script>
