<textarea id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}" class="{{ $class }}" rows="{{ $rows }}" cols="{{ $cols }}">{{ $slot }}</textarea>

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/9a1h0i1e6xl6jfpece6x4qxfilklxwznirv85dossgscftl2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#{{ $id }}',
            // plugins: 'lists link image table code help wordcount',
            // toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 300,
        });
    </script>
@endpush
