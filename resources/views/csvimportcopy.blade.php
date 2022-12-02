<!doctype html>
<html>

<head>
    <title>Import Data </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
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
            <form method='post' action='/uploadFile' enctype='multipart/form-data' id="fileUploadForm">
                {{ csrf_field() }}
                <div class="form-group mb-3">
                    <input type='file' name='file' class="form-control">
                    <input type='submit' name='submit' value='Import'>
                </div>

                <div class="form-group">
                  <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                  </div>
            </form>
        </div>


        <script>
          $(function () {
              $(document).ready(function () {
                  
                  var message = $('.success__msg');
                  $('#fileUploadForm').ajaxForm({
                      beforeSend: function () {
                          var percentage = '0';
                      },
                      uploadProgress: function (event, position, total, percentComplete) {
                          var percentage = percentComplete;
                          $('.progress .progress-bar').css("width", percentage+'%', function() {
                              return $(this).attr("aria-valuenow", percentage) + "%";
                          })
                      },
                      complete: function (xhr) {
                          console.log('File has uploaded');
                          message.fadeIn().removeClass('alert-danger').addClass('alert-success');
                          message.text("Uploaded File successfully.");
                          setTimeout(function () {
                              message.fadeOut();
                          }, 2000);
                          form.find('input:not([type="submit"]), textarea').val('');
                          var percentage = '0';
                      }
                  });
              });
          });
      </script>




</body>

</html>
