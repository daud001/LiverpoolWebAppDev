<?php include 'header.php' ?>
<table class="table table-hover">
    <caption><h1> Liverpool Player List</h1></caption>
    <thead>
    <tr>
        <th scope="col"> Player Name</th>
        <th scope="col"> Player Number</th>
        <th scope="col"> Position</th>
        <th scope="col"> Age </th>
        <th scope="col"> Nationality</th>
        <?php if (isset($_SESSION['username'])) : ?>
        <th scope="col"> Update </th>
        <th scope="col"> Delete</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($first_team as $player) : ?>
    <tr>
        <td><?php echo $player->getPlayerName(); ?></td>
        <td><?php echo $player->getPlayerNumber(); ?></td>
        <td><?php echo $player->getPlayerPosition(); ?></td>
        <td><?php echo $player->getAge(); ?></td>
        <td><?php echo $player->getNationality(); ?></td>

        <?php if (isset($_SESSION['username'])) : ?>
            <td>
            <form action="." method="post">
                <input type="hidden" name="action" value="show-update-player">
                <input type="hidden" name="ID" value="<?php echo $player->getId(); ?>">
                <input type="submit" class="btn btn-secondary" value="Update" aria-label="Update <?php echo $player->getPlayerName(); ?>">
            </form>
        </td>
        <td>
            <form action="." method="post">
                <input type="hidden" name="action" value="show-delete-player">
                <input type="hidden" name="ID" value="<?php echo $player->getId(); ?>">
                <input type="submit" class="btn btn-secondary" value="Delete" aria-label="Delete <?php echo $player->getPlayerName(); ?>">
            </form>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="form-group text-center">
    <form action="." method="post" class="btn-group">
        <input type="hidden" name="action" value="show-add-player">
        <input type="submit" class="btn btn-secondary" value="Add Player">
    </form>
</div>
<?php include 'footer.php'; ?>
