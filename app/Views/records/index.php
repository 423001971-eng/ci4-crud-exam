<h1>Records</h1>
<p><a href="/records/create">Add New Record</a> | <a href="/dashboard">Dashboard</a></p>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach($records as $record): ?>
    <tr>
        <td><?= $record['id'] ?></td>
        <td><?= $record['title'] ?></td>
        <td><?= $record['description'] ?></td>
        <td>
            <a href="/records/edit/<?= $record['id'] ?>">Edit</a> |
            <a href="/records/delete/<?= $record['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>