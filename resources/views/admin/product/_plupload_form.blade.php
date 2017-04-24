@section('head.styles')
<link rel="stylesheet" href="{{ asset('contents/plupload/jquery-ui.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('contents/plupload/jquery.ui.plupload.css') }}"/>
@endsection

@section('head.scripts')
<script src="{{ asset('contents/plupload/jquery-ui.min.js') }}"></script>
<script src="{{ asset('contents/plupload/plupload.full.min.js') }}"></script>
<script src="{{ asset('contents/plupload/jquery.ui.plupload.min.js') }}"></script>
<script src="{{ asset('contents/plupload/js/i18n/vi.js') }}"></script>
@endsection

<div id="uploader" class="uploader" style="width: 100% !important;">
	Trình duyệt của bạn không hỗ trợ Flash, Silverlight hoặc HTML5.
</div>
