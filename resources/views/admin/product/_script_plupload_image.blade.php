<script>
    var imageAdded = false;

    // Initialize the widget when the DOM is ready
    $(function() {
        $("#uploader").plupload({
            // General settings
            runtimes : 'html5,html4',
            url : "{{ route('admin.product.uploadimage') }}",
     
            // Maximum file size
            max_file_size : '1mb',
     
            chunk_size: '1mb',
     
            // Resize images on clientside if we can
            resize : {
                width : 200,
                height : 200,
                quality : 90,
                crop: false // crop to exact dimensions
            },
     
            // Specify what files to browse for
            filters : [
                {title : "Định dạng ảnh", extensions : "jpg,gif,png"}
            ],
     
            // Rename files by clicking on their titles
            rename: true,
             
            // Sort files
            sortable: true,
     
            // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
            dragdrop: true,
     
            // Views to activate
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
     
            // Flash settings
            flash_swf_url : '',
         
            // Silverlight settings
            silverlight_xap_url : ''
        });
    });
</script>

<script>
$(function(){
    $('#uploader_browse > span:first-child').remove();
    $('#uploader_start > span:first-child').remove();
});
</script>