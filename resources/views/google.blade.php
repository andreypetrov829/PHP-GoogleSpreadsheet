<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Toastr CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="category">ID:</label>
                    <input id="row1" type="number" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="category">Row1:</label>
                    <input id="row2" type="text" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="category">Row2:</label>
                    <input id="row3" type="text" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="category">Row3:</label>
                    <input id="row4" type="text" class="form-control" />
                </div>
                <button class="btn btn-success" type="button" onClick="submit()">submit</button>
            </div>
        </div>
        <div class="spinner-bg hide">
            <div class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
        <script>
            const submit = () => {
                if (!$("#row1").val()) {
                    toastr.error("Please fill ID");
                    return;
                }
                $(".spinner-bg").removeClass("hide");
                const data = {
                    _token: $("[name='csrf-token']").attr('content'),
                    row1: $("#row1").val(),
                    row2: $("#row2").val(),
                    row3: $("#row3").val(),
                    row4: $("#row4").val()
                };
                $.ajax({
                    type: "post",
                    url: "send-data",
                    data: data,
                    success: function (response) {
                        toastr.success(response);
                        $(".spinner-bg").addClass("hide");
                    }
                });
            }
        </script>
    </body>
</html>
