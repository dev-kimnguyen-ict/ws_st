<html lang="en">
<head>
    <title>File upload progress bar with percentage using form jquery example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid text-center">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">{{config('app.name')}}</a>
        </div>
    </div>
</nav>
<div class="container text-center">
    <h2>PHP - File upload progress bar and percentage with jquery</h2>
    <div style="border: 1px solid #a1a1a1;text-align: center;width: 500px;padding:30px;margin:0px auto">
        <form
            method="post"
            action="{{route('admin.upload.store')}}"
            enctype="multipart/form-data"
            class="form-horizontal"
        >
            {{csrf_field()}}
            <div class="preview"></div>
            <div class="progress" style="display:none">
                <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="0"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    style="width:0%"
                >
                    0%
                </div>
            </div>

            <input type="file" name="image" id="upload" class="form-control"/>
            <button class="btn btn-primary upload-image">Upload Image</button>
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://malsup.github.com/jquery.form.js"></script>
    <script>
        $(document).ready(function () {

            var progressbar = $('.progress-bar');

            $("#upload").change(function (e) {
                e.preventDefault();
                $(".form-horizontal").ajaxForm(
                    {
                        target: '.preview',
                        beforeSend: function () {
                            $(".progress").css("display", "block");
                            progressbar.width('0%');
                            progressbar.text('0%');
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            progressbar.width(percentComplete + '%');
                            progressbar.text(percentComplete + '%');
                        }
                    })
                    .submit();
            });

        });
    </script>
</div>
</body>
</html>
