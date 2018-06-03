<?php if (! empty($errors)): ?>
    <?php foreach($errors as $error): ?>
        <p><?= $error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<form method="post">
    <div>
        <label for="title">Title</label>
        <input name="title" id="title" type="text" placeholder="Article title" value="<?= htmlspecialchars($title); ?>">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" placeholder="Article contenta"><?= htmlspecialchars($content); ?></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input id="published_at" value="<?= htmlspecialchars($published_at); ?>" name="published_at" type="datetime-local">
    </div>

    <button>Save</button>
    
</form>