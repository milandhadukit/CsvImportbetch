<!doctype html>
<html>

<head>
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Import Data </title>

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
            color: #1765b3;
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
            {{-- <form method='post'action="{{ route('uploadFile') }}"  enctype='multipart/form-data' id="uploadForm">  --}}

            {{-- <form method='post' id="SubmitForm" action="{{ route('uploadFile') }}" enctype="multipart/form-data"> --}}

            {{-- {{ csrf_field() }} --}}
            {{-- <div class="form-group">
                    <input type='file' name='file' class="form-control" id="InputName" required>
                    <input type='submit' name='submit' value='Import'>
                </div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <div id="uploadStatus"></div>


            </form>  --}}


            {{-- <form id="SubmitForm" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="InputName" class="form-label">file:</label>
                    <input type='file' name='file' class="form-control" id="InputName" required>
                    <span class="text-danger" id="nameErrorMsg"></span>
                </div>

                <input type='submit' name='submit' id="submitButton" value='Import'>

                <div class="progress"></div>
                <div class="progress-bar"></div>




        </div>
        </form> --}}


        <div class="form-container">
            <form action="{{ route('uploadFile') }}" id="uploadForm" name="frmupload"
                method="post" enctype="multipart/form-data">
                <input type="file" id="uploadImage" name="file" /> <input
                    id="submitButton" type="submit" name='btnSubmit'
                    value="Submit Image" />
    
            </form>
            <div class='progress' id="progressDivId">
                <div class='progress-bar' id='progressBar'></div>
                <div class='percent' id='percent'>0%</div>
            </div>
            <div style="height: 10px;"></div>
            <div id='outputImage'></div>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            
    $('#submitButton').click(function () {

    	    $('#uploadForm').ajaxForm({
    	        target: '#outputImage',
    	        url: "{{ route('uploadFile') }}",
    	        uploadProgress: function (event, position, total, percentComplete) {
                    console.log(event, position, total, percentComplete);

    	            var percentValue = percentComplete + '%';
    	            $("#progressBar").animate({
    	                width: '' + percentValue + ''
    	            }, {
    	                duration: 5000,
    	                easing: "linear",
    	                step: function (x) {
                        percentText = Math.round(x * 100 / percentComplete);
    	                    $("#percent").text(percentText + "%");
                        if(percentText == "100") {
                        	   $("#outputImage").show();
                        }
    	                }
    	            });
    	        },
    	        error: function (response, status, e) {
    	            alert('Oops something went.');
    	        },
    	        
    	        complete: function (xhr) {
    	            if (xhr.responseText && xhr.responseText != "error")
    	            {
    	            	  $("#outputImage").html(xhr.responseText);
    	            }
    	            else{  
    	               	$("#outputImage").show();
        	            	$("#outputImage").html("<div class='error'>Problem in uploading file.</div>");
        	            	$("#progressBar").stop();
    	            }
    	        }
    	    });
    });
});
    </script>

    {{-- <script type="text/javascript">
        $('#SubmitForm').on('submit', function(e) {


            e.preventDefault();

            var fd = new FormData();
            var files = $('#InputName')[0].files;

            if (files.length > 0) {
                fd.append('file', files[0]);
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            

            $.ajax({
                url: "{{ route('uploadFile') }}",
                type: "POST",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('okkkk');
                },
                beforeSend: function ( jqXHR, settings) {
                    var perrr  = 0;
                },
                afterSend: function(){
                    
                },
                done: function(){
                    
                },
                success: function(){
                    
                },
                xhr: function () {
                    var xhr = $.ajaxSettings.xhr();

                    xhr.upload.onprogress = function (e) {
                        // For uploads
                        if (e.lengthComputable) {
                            perrr +=(e.loaded / e.total)* 100;
                            $('.progress-bar').html(perrr);
                        }
                    };

                    // xhr.onprogress = function e() {
                    //     // For downloads
                    //     if (e.lengthComputable) {
                    //         perrr += (e.loaded / e.total)* 50;
                    //         console.log('dddd',perrr);
                    //     }
                    // };
                   
                    return xhr;
                }
            });
        });
    </script> --}}




</body>

</html>
