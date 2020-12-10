<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('user.layout.header')
@yield('content')
@include('user.layout.footer')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // добавления отзыва пользователем
    function addReview(idUser) {
        var review = $('#review').val();
        var idNews = $('#idNews').val();

        $.ajax({
            url: '{{ route('add-review') }}',
            method: "POST",
            data: {idUser:idUser, review:review, idNews:idNews},
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

            // если отзыв успешный, показываем модальное окно с успехом
            success: function (data) {
                window.$('#myModal').modal('show');
                $('#review').val('');
            },

            // если есть ошибки в отзыве, показываем модальное окно с ошибками
            error: function (msg) {
                var response  = JSON.parse(msg.responseText);
                $.each( response.errors, function( key, value) {
                    $('#errorModalMessage').append('<p class="text-danger">' + value + '</p>');
                    window.$('#errorModal').modal('show');
                });
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>