<?php foreach ($games as $game): ?>
    <div class="game-card">
        <img src="/uploads/<?= $game['image']; ?>" alt="Game Image">
        <h5><?= $game['name']; ?></h5>
        <a href="/admin/games/delete/<?= $game['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this game?')">Delete</a>
    </div>
<?php endforeach; ?>
