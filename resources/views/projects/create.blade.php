<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
</head>

<body>

    <form method="POST" action="/projects" class="container" style="padding-top: 40px">
        @csrf        
        <h1 class="heading is-l">Create a Project</h1>

        <div class="field">
            <labl class="label" for="title">Title</labl>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title">
            </div>
        </div>


        <div class="field">
            <labl class="label" for="description">Description</labl>
        
            <div class="control">
                <textarea name="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
            </div>
        </div>
    <form>
</body>

</html>