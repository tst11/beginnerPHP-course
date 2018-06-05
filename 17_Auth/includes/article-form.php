<?php if (! empty($article->errors)): ?>
    <?php foreach($article->errors as $error): ?>
        <p><?= $error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<form method="post">
    <div>
        <label for="title">Title</label>
        <input name="title" id="title" type="text" placeholder="Article title" value="<?= htmlspecialchars($article->title); ?>">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" placeholder="Article contenta"><?= htmlspecialchars($article->content); ?></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input id="published_at" value="<?= htmlspecialchars($article->published_at); ?>" name="published_at" type="datetime-local">
    </div>

    <button>Save</button>
    
</form>