<!doctype html>
<html>

<head>
    <title>Import Data </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .progress {
        position: relative;
        width: 100%;
    }

    .bar {
        background-color: #00ff00;
        width: 0%;
        height: 20px;
    }

    .percent {
        position: absolute;
        display: inline-block;
        left: 50%;
        color: #040608;
    }
</style>
</head>

<body>
    <!-- Message -->
    @if (Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif


    <div class="container mt-5" style="max-width: 900px">
        <div class="bg-dark p-4 text-center rounded-3 mb-2">
            <h2 class="text-white m-0">Welcome</h2>
        </div>
        <!-- Starting of successful form message -->
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success success__msg bg-dark" style="display: none; color: white;" role="alert">
                    Uploaded File successfully.
                </div>
            </div>
        </div>
        <!-- Ending of successful form message -->
        <div class="card bg-transparent border rounded-3 mb-5 p-5">

            <!-- Form -->
            {{-- <form method='post' action='/uploadFile'  enctype='multipart/form-data' id="uploadForm">  --}}

            <form method='post' action="{{ route('uploadFile') }}" enctype="multipart/form-data" id="fileUploadForm">

                @csrf
                <div class="form-group">
                    <input type='file' name='file' class="form-control" id="fileInput" required>
                    <input type='submit' name='submit' value='Import'>
                </div>

                <div class="progress-bar"></div>




            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
        <script>
            $(function() {
                $(document).ready(function() {

                    var percentage = 0;

                    $('#fileUploadForm').ajaxForm({
                        beforeSend: function() {

                            percentage = '0';

                        },


                        uploadProgress: function (event, position, total, percentComplete) {

                            percentage = percentComplete;
                            $(".progress-bar").width(percentage + '%');
                            $(".progress-bar").html(percentage + '%');

                        },

                     
                        complete: function(xhr) {
                            console.log(xhr);
                            alert(' successfully');
                        }
                    });
                });
            });
        </script>



</body>

</html>
