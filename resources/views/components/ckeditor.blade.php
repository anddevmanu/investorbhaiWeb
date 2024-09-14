<div class="ckeditor-container">
    <textarea id="{{ $id }}" name="{{ $name }}">{{ $value }}</textarea>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#{{ $id }}'))
                .then(editor => {
                    console.log('Editor was initialized', editor);
                })
                .catch(error => {
                    console.error('Error during initialization of the editor', error);
                });
        });
    </script>
</div>


