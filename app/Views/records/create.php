<h1>Create Record</h1>
<form action="/records/create" method="post">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>
    
    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>
    
    <button type="submit">Save</button>
</form>
<p><a href="/records">Back to Records</a></p>