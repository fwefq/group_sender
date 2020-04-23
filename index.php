<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script>
        function onFileSelected(event) {
            Array.from(event.target.files).map(file => {
                const reader = new FileReader();

                reader.onload = e => {
                    const image = document.createElement('img')
                    image.src = e.target.result;
                    document.querySelector('.images').appendChild(image);
                }

                reader.readAsDataURL(file);
            });
        }
    </script>

    <form action="/upload.php" enctype="multipart/form-data" method="POST">
        <textarea name="links" cols="30" rows="10"></textarea>
        <br>
        <textarea name="message" cols="30" rows="10"></textarea>
        <br>
        <br>
        <input type="file" name="photos[]" accept="image/x-png,image/jpeg" multiple onchange="onFileSelected()">
        <br>
        <div class="images"></div>
        <br>
        <button>Send</button>
    </form>
</body>
</html>
