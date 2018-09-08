<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script type="text/javascript">
        $(document).ready(()=>{
            getItems()
        });
        function getItems(){
                $.ajax({
                    url: 'http://localhost:8000/api/items',
                }).done((items)=>{
                    let output = '';
                    $.each(items, function(key, item){
                        output+=`
                            <li class="list-group-item">
                                <strong>${item.text}: </strong>${item.body}
                            </li>`;
                    })
                    $('#items').append(output);
                })
            }
    </script>
</head>
<body>
    <div class="bs-component">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Item Manager</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
                </li>

            </ul>
            </div>
        </nav>
    </div>
    <div class="container">
        <ul id="items" class="list-group"></ul>
    </div>
</body>
</html>
