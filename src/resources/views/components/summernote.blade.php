@section('css')
<link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('summernote/summernote.min.css') }}" rel="stylesheet">
@append

@section('scripts')
<script src="{{ asset('summernote/summernote.min.js') }}"></script>
<script>
$(document).ready(function() {
	$('#text').summernote({
		minHeight: 250,
	});
	$('.dropdown-toggle').dropdown();
});
</script>
@append