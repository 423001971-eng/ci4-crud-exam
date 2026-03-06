<h1>Edit Record</h1>
<form action="/records/edit/<?= $record['id'] ?>" method="post">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?= $record['title'] ?>" required><br><br>
    
    <label>Description:</label><br>
    <textarea name="description" required><?= $record['description'] ?></textarea><br><br>
    
    <button type="submit">Update</button>
</form>
<p><a href="/records">Back to Records</a></p>