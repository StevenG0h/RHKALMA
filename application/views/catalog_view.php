<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?= base_url('Catalog/insertCatalog') ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="komentar" id="">
        <input type="file" name="gambar" id="">
        <input type="submit" value="submit">
    </form>
</body>

</html>