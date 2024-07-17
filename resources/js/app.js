import './bootstrap';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


// Inicializar CKEditor en los elementos que tengan el ID 'editor'
document.addEventListener('DOMContentLoaded', function () {
    const editors = document.querySelectorAll('#editor',{

        simpleUpload: {
            // The URL that the images are uploaded to.
            uploadUrl: "{{route('images.upload')}}",

        }
    });
    editors.forEach((editor) => {
        ClassicEditor.create(editor).catch(error => {
            console.error(error);
        });
    });
});



