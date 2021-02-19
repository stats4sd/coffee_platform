@if ($crud->hasAccess('update'))
	<a href="{{ url($crud->route.'/export') }}" class="btn btn-success" data-button-type="export"><i class="la la-download"></i> Export {{ $crud->entity_name_plural }}</a>
@endif
