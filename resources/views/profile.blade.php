<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    
    <title>Prof</title>
</head>
<body>
    @component('components.alert') @endcomponent
    
    <h1>profile page</h1>
    <img src="{{ asset('uploads/avatars/id') }}{{ $user->id }}/{{ $user->profile_picture }}" style="width:200px;">
    Perfil de {{ $user->name }}

    <form enctype="multipart/form-data" action="{{ route('change.avatar', ['user' => $user->id]) }}" method="POST">
        @csrf
        <label>Update</label>
        <input type="file" name="avatar">
        <input type="submit" name="submit" id="submit">
    </form>

    <form action="{{ route('pic.destroy', ['user' => $user->id]) }}" method="POST">
        @method('delete')
        @csrf
        <input type="submit" name="submit" id="submit" value="DELETE">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
    <script>
        $("document").ready(function(){
            setTimeout(function(){
            $("div.alert").remove();
            }, 2500 );
        });
    </script>
</body>
</html>