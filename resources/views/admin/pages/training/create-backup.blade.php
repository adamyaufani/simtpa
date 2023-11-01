@if(old('category_id')!=null)
    <script>
        const category_id = "{{ old('category_id') }}";
        const category_name =
            "{{ App\Models\Category::find(old('category_id'))->name }}";
        $("#select_category").html('<option value="' + category_id + '" selected>' + category_name +
            '</option>');

    </script>
@endif
