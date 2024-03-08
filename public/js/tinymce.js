tinymce.init({
    selector: 'textarea',

    skin: 'oxide-dark',
    language: 'fr_FR',

    menubar: 'file edit insert',
    menu: {
        file: { title: 'File', items: 'newdocument' },
        edit: { title: 'Edit', items: 'cut copy paste pastetext | selectall | searchreplace' },
        insert: { title: 'Insert', items: 'image link' },
    },
    toolbar: 'styles | bold italic underline | alignleft aligncenter alignright alignjustify || undo redo',

    plugins: 'wordcount',
});