<div>
    <textarea class="form-control" name="{{$name}}" >{{$text}}</textarea>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap preview hr anchor pagebreak',
        toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | alignleft aligncenter alignright alignjustify | link image media | removeformat help',
        quickbars_image_toolbar: 'alignleft aligncenter alignright | rotateleft rotateright | imageoptions',
        toolbar_mode: 'floating',
        statusbar: false,
        height:300,
    });
</script>
</div>