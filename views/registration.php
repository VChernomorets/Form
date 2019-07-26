<form class="form form__registration visible" id="registrationForm" action="../handler.php" method="post">
    <label class="aboutMeForm__question" for="email">
        Enter your email
    </label>
    <input type="text" class="aboutMeForm__text" name="mail" id="email" placeholder="arya@westeros.com">
    <?php if (!($_SESSION['flags']['mail'] ?? true)): ?>
        <div class="errorMessage">Invalid mail.</div>
    <?php elseif (!($_SESSION['flags']['accountExists'] ?? true)) : ?>
        <div class="errorMessage">Account exists!.</div>
    <?php endif; ?>
    <label class="aboutMeForm__question" for="password">
        Choose secure password
        <span class="aboutMeForm__hint">Most be at least 8 characters</span>
    </label>
    <input type="password" name="password" class="aboutMeForm__text" id="password" placeholder="password">
    <?php if (!($_SESSION['flags']['password'] ?? true)): ?>
        <div class="errorMessage">Incorrect password.</div>
    <?php endif; ?>
    <input type="checkbox" class="aboutMeForm__remember" name="remember" id="remember">
    <label for="remember" class="aboutMeForm__question">Remember me</label>
    <input type="submit" value="save" class="aboutMeForm__submitSave" id="registrationSave" name="registrationSave">
</form>
<?php
session_destroy();
?>