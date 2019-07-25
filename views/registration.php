<form class="form form__registration visible" id="registrationForm" action="../handler.php" method="post">
    <label class="aboutMeForm__question" for="email">
        Enter your email
    </label>
    <input type="text" class="aboutMeForm__text" name="mail" id="email" placeholder="arya@westeros.com">
    <?php if (isset($_SESSION['flags']['mail']) && !$_SESSION['flags']['mail']) { ?>
        <div class="errorMessage">Invalid mail.</div>
    <?php } ?>
    <?php if (isset($_SESSION['flags']['accountExists']) && !$_SESSION['flags']['accountExists']) { ?>
        <div class="errorMessage">Account exists!.</div>
    <?php } ?>
    <label class="aboutMeForm__question" for="password">
        Choose secure password
        <span class="aboutMeForm__hint">Most be at least 8 characters</span>
    </label>
    <input type="password" name="password" class="aboutMeForm__text" id="password" placeholder="password">
    <?php if (isset($_SESSION['flags']['password']) && !$_SESSION['flags']['password']) { ?>
        <div class="errorMessage">Incorrect password.</div>
    <?php } ?>
    <input type="checkbox" class="aboutMeForm__remember" name="remember" id="remember">
    <label for="remember" class="aboutMeForm__question">Remember me</label>
    <input type="submit" value="save" class="aboutMeForm__submitSave" id="registrationSave" name="registrationSave">
</form>
<?php
session_destroy();
?>