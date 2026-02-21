<form action="/admin/games/save" method="POST" enctype="multipart/form-data">
    <div>
        <label for="name">Game Name</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" id="image" name="image" required>
    </div>
    <button type="submit">Save Game</button>
</form>
