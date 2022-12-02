<!doctype html>
<html>

<head>
    <title>Import Data </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
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

<body class="bg-dark">
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
                <div class="alert alert-success success__msg bg-dark" style="display: none; color: white;"
                    role="alert">
                    Uploaded File successfully.
                </div>
            </div>
        </div>
        <!-- Ending of successful form message -->
        <div class="card bg-transparent border rounded-3 mb-5 p-5">

            <!-- Form -->
            <form method='post' action='/uploadFile' enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="form-group">
                    <input type='file' name='file' class="form-control" required>
                    <input type='submit' name='submit' value='Import'>
                </div>
                <div class="progress">
                    <div class="bar"></div>
                    <div class="percent">0%</div>
                </div>


               

            </form>
        </div>


        <script type="text/javascript">
            $(function() {
                $(document).ready(function() {
                    var bar = $('.bar');
                    var percent = $('.percent');
                    $('form').ajaxForm({
                        beforeSend: function() {



                            var percentVal = '0%';
                            bar.width(percentVal)
                            percent.html(percentVal);




                        

                        },
                        uploadProgress: function(event, position, total, percentComplete) {
                            var percentVal = percentComplete + '%';
                            bar.width(percentVal)
                            percent.html(percentVal);
                        },
                        complete: function(xhr) {
                            alert('File Has Been Uploaded Successfully');

                        }
                    });
                });
            });
        </script>




</body>

</html>
