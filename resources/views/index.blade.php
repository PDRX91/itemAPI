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
            getItems();
            addListener();
        });

        function addListener(){
            $('#itemForm').on('submit', (e) => {
            e.preventDefault();

            let text = $('#text').val();
            let body = $('#body').val();

            addItem(text, body);
            });

            $('body').on('click', '.deleteLink', (e) =>{
                e.preventDefault();

                let id = $(this).data('id');
                console.log(id);
            })

        }


        function addItem(text, body){
            $.ajax({
                method: 'POST',
                url: 'http://localhost:8000/api/items',
                data: {text: text, body: body}
            }).done((item)=>{
                alert(`Item # ${item.id} added`);
                location.reload();
            })
        }

        function getItems(){
                $.ajax({
                    url: 'http://localhost:8000/api/items',
                }).done((items)=>{
                    let output = '';
                    $.each(items, function(key, item){
                        output+=`
                            <li class="list-group-item">
                                <strong>${item.text}: </strong>${item.body} <a href="#" class="deleteLink" data-id="${item.id}">Delete</a>
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
        <h1>Add Item</h1>
        <form action="" id="itemForm">
            <div class="form-group">
                <label >Text</label>
                <input type="text" id="text" class="form-control">
            </div>
            <div class="form-group">
                <label >Body</label>
                <textarea id="body" class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
        <hr>
        <ul id="items" class="list-group"></ul>
    </div>
</body>
</html>
