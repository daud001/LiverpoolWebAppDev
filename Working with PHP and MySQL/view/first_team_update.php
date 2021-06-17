<?php include 'header.php'; ?>
    <h1 class="text-center"> Update Player </h1>
    <form action="." method="post" class="col-lg-6 mx-auto">
        <hr>
        <div class="form-group">
            <label>Player ID</label>
            <input type="text" class="form-control" name="ID" id="ID" value="<?php echo $player->getId(); ?>" disabled>
        </div>
        <div class="form-group">
            <label for="player-name">Player Name</label>
            <input type="text" class="form-control <?php echo (!empty($playerNameError)) ? 'is-invalid' : ''; ?>" name="player-name" id="player-name" placeholder="Player Name"
                   value="<?php echo isset($playerName) ? $playerName : $player->getPlayerName(); ?>" autofocus>
            <?php if (!empty($playerNameError)) echo $playerNameError; ?>
        </div>
        <div class="form-group">
            <label for="player-number">Player Number</label>
            <input type="text" class="form-control <?php echo (!empty($playerNumberError)) ? 'is-invalid' : ''; ?>" name="player-number" id="player-number" placeholder="Player Number"
                   value="<?php echo isset($playerNumber) ? $playerNumber : $player->getPlayerNumber(); ?>">
            <?php if (!empty($playerNumberError)) echo $playerNumberError; ?>
        </div>
        <div class="form-group">
            <label for="player-position">Position</label>
            <select class="custom-select <?php echo (!empty($playerPositionError)) ? 'is-invalid' : ''; ?>" name="player-position" id="player-position">
                <option value="Goalkeeper" <?php if ($playerPosition === 'Goalkeeper' || (!isset($playerPosition) && $player->getPlayerPosition() == 'Goalkeeper')) echo ' selected'; ?>>Goalkeeper</option>
                <option value="Defender" <?php if ($playerPosition === 'Defender' || (!isset($playerPosition) && $player->getPlayerPosition() == 'Defender'))  echo ' selected'; ?>>Defender</option>
                <option value="Midfielder" <?php if ($playerPosition === 'Midfielder' || (!isset($playerPosition) && $player->getPlayerPosition() == 'Midfielder'))  echo ' selected'; ?>>Midfielder</option>
                <option value="Attacker" <?php if ($playerPosition === 'Attacker' || (!isset($playerPosition) && $player->getPlayerPosition() == 'Attacker'))  echo ' selected'; ?>>Attacker </option>
            </select>
            <?php if (!empty($playerPositionError)) echo $playerPositionError; ?>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control <?php echo (!empty($ageError)) ? 'is-invalid' : ''; ?>" name="age" id="age" placeholder="Age"
                   value="<?php echo isset($age) ? $age : $player->getAge(); ?>">
            <?php if (!empty($ageError)) echo $ageError; ?>
        </div>
        <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" class="form-control <?php echo (!empty($nationalityError)) ? 'is-invalid' : ''; ?>" name="nationality" id="nationality" placeholder="Nationality"
                   value="<?php echo isset($nationality) ? $nationality : $player->getNationality(); ?>">
            <?php if (!empty($nationalityError)) echo $nationalityError; ?>
        </div>
        <div class="form-group text-center">
            <input type="hidden" name="ID" value="<?php echo $player->getId(); ?>">
            <input type="hidden" name="action" value="update-player">
            <input type="submit" class="btn btn-secondary" value="Update Player">
            <a href="." class="btn btn-secondary"> Cancel</a>
        </div>
    </form>
<?php include 'footer.php'; ?>