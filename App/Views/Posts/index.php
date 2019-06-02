
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <?php foreach ($posts as $post): ?>
        <h2><?=htmlspecialchars($post['title'])?></h2>
        <span><?=htmlspecialchars($post['content'])?></span>
        <hr />
    <?php endforeach; ?>
</body>
</html>
