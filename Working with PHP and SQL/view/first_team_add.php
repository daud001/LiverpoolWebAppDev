<?php include 'header.php'; ?>
<h1 class="text-center"> Add Player </h1>
<form action="." method="post" class="col-lg-6 mx-auto">
    <hr>
    <div class="form-group">
        <label for="player-name">Player Name</label>
        <input type="text" class="form-control <?php echo (!empty($playerNameError)) ? 'is-invalid' : ''; ?>" name="player-name" id="player-name" placeholder="Player Name"
               value="<?php if (!is_null($playerName)) echo $playerName; ?>" autofocus>
        <?php if (!empty($playerNameError)) echo $playerNameError; ?>
    </div>
    <div class="form-group">
        <label for="player-number">Player Number</label>
        <input type="text" class="form-control <?php echo (!empty($playerNumberError)) ? 'is-invalid' : ''; ?>" name="player-number" id="player-number" placeholder="Player Number"
               value="<?php if (!is_null($playerNumber)) echo $playerNumber; ?>">
        <?php if (!empty($playerNumberError)) echo $playerNumberError; ?>
    </div>
    <div class="form-group">
        <label for="player-position">Position</label>
        <select class="custom-select <?php echo (!empty($playerPositionError)) ? 'is-invalid' : ''; ?>" name="player-position" id="player-position">
            <option value="choose"> Specify Position</option>
            <option value="Goalkeeper" <?php if ($playerPosition === 'Goalkeeper') echo ' selected'; ?>>Goalkeeper</option>
            <option value="Defender" <?php if ($playerPosition === 'Defender') echo ' selected'; ?>>Defender</option>
            <option value="Midfielder" <?php if ($playerPosition === 'Midfielder') echo ' selected'; ?>>Midfielder</option>
            <option value="Attacker" <?php if ($playerPosition === 'Attacker') echo ' selected'; ?>>Attacker </option>
        </select>
        <?php if (!empty($playerPositionError)) echo $playerPositionError; ?>
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" class="form-control <?php echo (!empty($ageError)) ? 'is-invalid' : ''; ?>" name="age" id="age" placeholder="Age"
               value="<?php if (!is_null($age)) echo $age; ?>">
        <?php if (!empty($ageError)) echo $ageError; ?>
    </div>
    <div class="form-group">
        <label for="nationality">Nationality</label>
        <input type="text" class="form-control <?php echo (!empty($nationalityError)) ? 'is-invalid' : ''; ?>" name="nationality" id="nationality" placeholder="Nationality"
               value="<?php if (!is_null($nationality)) echo $nationality; ?>">
        <?php if (!empty($nationalityError)) echo $nationalityError; ?>
    </div>
    <div class="form-group text-center">
        <input type="hidden" name="action" value="add-player">
        <input type="submit" class="btn btn-secondary" value="Add Player">
        <a href="." class="btn btn-secondary"> Cancel</a>
    </div>
</form>
<?php include 'footer.php'; ?>