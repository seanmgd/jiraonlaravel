<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <title>Document</title>
</head>

<body>
    <form class="container" style="padding-top:50px" method="POST" action="/projects">
        <h1 class="heading is-1">Create a Project</h1>
        <div class="field">
            <label for="title" class="label">Title</label>
            <div class="control">
                <input type="text" class="input" name="title" placeholder="title">
            </div>
        </div>
        <div class="field">
            <label for="description" class="label">description</label>
            <div class="control">
                <textarea type="text" class="input" name="description"> </textarea>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
            </div>
        </div>
    </form>

</body>

</html>