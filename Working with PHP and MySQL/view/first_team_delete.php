<?php include 'header.php'; ?>
    <h1 class="text-center"> Delete Player Confirmation </h1>
    <h3 class="text-center"> Are you sure you want to delete? </h3>

    <form action="." method="post" class="col-lg-6 mx-auto">
        <hr>

        <h5>Player ID</h5>
        <p> <?php echo $player->getId(); ?> </p>

        <h5>Player Name</h5>
        <p><?php echo isset($playerName) ? $playerName : $player->getPlayerName(); ?> </p>

        <h5>Player Number</h5>
        <p><?php echo isset($playerNumber) ? $playerNumber : $player->getPlayerNumber(); ?> </p>

        <h5>Position</h5>
        <p><?php echo $player->getPlayerPosition(); ?></p>

        <h5>Age</h5>
        <p> <?php echo isset($age) ? $age : $player->getAge(); ?> </p>

        <h5>Nationality</h5>
        <p><?php echo isset($nationality) ? $nationality : $player->getNationality(); ?></p>

        <div class="form-group text-center">
            <input type="hidden" name="ID" value="<?php echo $player->getId(); ?>">
            <input type="hidden" name="action" value="delete-player">
            <input type="submit" class="btn btn-secondary" value="Yes, Delete Player">
            <a href="." class="btn btn-secondary"> No, Do Not Delete Player </a>
        </div>
    </form>
<?php include 'footer.php'; ?>