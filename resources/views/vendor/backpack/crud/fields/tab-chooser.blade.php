@push('crud_fields_scripts')
<script>
    var splitByYear = {{ $entry->unitType->split_by_year }};
    console.log('splitByYear', splitByYear);

    if(splitByYear == 1) {
        $('[tab_name="types-split-by-year"]').click();
    }
</script>
@endpush