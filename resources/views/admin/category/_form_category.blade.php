<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>

<div class="formRow">
    {!! Form::label('name', 'Tên danh mục (*):', ['class' => 'formLeft']) !!}
    <div class="formRight">
        <div class="oneTwo">
            {!! Form::text('name', isset($category->name) ? $category->name : null, ['_autocheck' => 'true', 'required' => 'true']) !!}
            <span class="autocheck" name="name_autocheck"></span>
            <div class="clear error" name="name_error">
                @if ($errors->has('name'))
                    {{ $errors->first('name') }}
                @endif
            </div>
        </div>
        <div class="oneTwo">
            <select name="parent_id" class="select-category textC" style="margin-left: 100px;">
                <option value="0" style="font-weight: bold;">--- Chọn danh mục cha ---</option>
                @foreach($categories as $parent)
                    <option
                        @if(isset($category) && $category->parent_id == $parent->getKey())
                        selected="selected"
                        @endif
                        value="{{$parent->getKey()}}">
                        {{$parent->name}}
                    </option>
                @endforeach
            </select>
            <span class="autocheck" name="name_autocheck" style="margin-left: 90px;"></span>
            <div class="clear error" name="name_error" style="margin-left: 90px;">
                @if ($errors->has('parent_id'))
                    {{ $errors->first('parent_id') }}
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
                <input id="hien_thi" type="radio" name="active"
                       @if((isset($category) && $category->active == true) || !isset($category->active))
                       checked="true"
                       @endif
                       value="1"/>
                {!! Form::label('hien_thi', 'Hiển thị') !!}
            </div>
            <div class="radiobox">
                <input id="an" type="radio" name="active"
                       @if(isset($category) && $category->active == false)
                       checked="true"
                       @endif
                       value="0"/>
                {!! Form::label('an', 'Ẩn') !!}
            </div>
            <div class="clear error" name="name_error">
                @if ($errors->has('active'))
                    <strong>{{ $errors->first('active') }}</strong>
                @endif
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow">
    <div class="formRight">
        <a id="adddesc" href="javascript:void(0)">Thêm mô tả danh mục</a>
    </div>
    <div class="clear"></div>
</div>

<div class="formRow" style="display: none;" id="container_mo_ta">
    {!! Form::label('description', 'Mô tả:', ['class' => 'formLeft']) !!}
    <div class="formRight">
        {!! Form::textarea('description', $category->description ?? null, ['_autocheck' => 'true']) !!}
        <span class="autocheck" name="name_autocheck"></span>
        <div class="clear error" name="name_error">
            @if ($errors->has('description'))
                {{ $errors->first('description') }}
            @endif
        </div>
    </div>
    <div class="clear"></div>
</div>


<div class="formRow">
    <label for="seo_title" style="font-weight: bold; font-size: 16px;" class="textC">Tối ưu SEO</label>
    <div class="clear"></div>
</div>

<div class="formRow">
    {!! Form::label('seo_title', 'Thẻ tiêu đề (*):') !!}
    <div class="formRight">
        <div class="oneTwo">
            <div class="input-helper">
                {!! Form::text('seo_title', $category->seo->title ?? null, ['required' => true, 'size' => '70']) !!}
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
                {!! Form::text('seo_description', $category->seo->description ?? null, ['max' => 160]) !!}
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
    {!! Form::label('seo_alias', 'Đường dẫn / Bí danh (*):') !!}
    <div class="formRight">
        <div class="oneTwo">
            {!! Form::text('seo_alias', $category->seo->alias ?? null, ['required' => true]) !!}
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
    var seoTitleSize = 70,
        seoDescriptionSize = 160,
        subfixSelTitle = '/' + seoTitleSize,
        subfixSeoDescription = '/' + seoDescriptionSize,
        txtTenSP = $('#name'),
        seoMoTa = $('#seo_description'),
        seoMoTaLength = $('#seo_description_length'),
        seoTieuDe = $('#seo_title'),
        seoTieuDeLength = $('#seo_title_length'),
        seoAlias = $('#seo_alias');
    CKEDITOR.replace('description');

    $('#adddesc').click(function () {
        $(this).parent('div').parent('div').remove();
        $('#container_mo_ta').show();
    });

    $(function () {
        // processSeoTieuDe(txtTenSP.val());
        seoTieuDeLength.html(seoTieuDe.val().length + subfixSelTitle);
        seoMoTaLength.html(seoMoTa.val().length + subfixSeoDescription);
        // seoAlias.val(changeToSlug(txtTenSP.val()));
    });

    txtTenSP.keyup(function (e) {
        processTieuDeChange(e.target.value);
    });
    txtTenSP.change(function (e) {
        processTieuDeChange(e.target.value);
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

    function processSeoTieuDe (value, exception) {
        if (value.length > seoTitleSize) {
            seoTieuDeLength.html(seoTitleSize + subfixSelTitle);
            seoTieuDe.val(value.slice(0, seoTitleSize));
        } else {
            if (exception) seoTieuDe.val(value);
            seoTieuDeLength.html(value.length + subfixSelTitle);
        }
    }
    function processTieuDeChange (value) {
        processSeoTieuDe(value, true);
        seoAlias.val(changeToSlug(value));
    }

    function processSeoMoTa (value) {
        if (value.length > seoDescriptionSize) {
            seoMoTaLength.html(seoDescriptionSize + subfixSeoDescription);
            seoMoTa.val(value.slice(0, seoDescriptionSize));
        } else {
            seoMoTaLength.html(value.length + subfixSeoDescription);
        }
    }
</script>
