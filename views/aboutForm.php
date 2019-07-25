<div class="aboutMeSection" id="aboutMe">
    <p class="alert">
        You've successfully joined the game.<br>
        Tell us more about yourself.
    </p>
    <form class="form" action="../handler.php" method="post">
        <label class="aboutMeForm__question" for="username">
            Who are you?
            <span class="aboutMeForm__hint">Alpha-numeric username</span>
        </label>
        <input type="text" class="aboutMeForm__text" id="username" placeholder="arya" name="username" required>
        <?php if (isset($_SESSION['flags']['username']) && !$_SESSION['flags']['username']) { ?>
            <div class="errorMessage">Invalid username.</div>
        <?php } ?>
        <label class="aboutMeForm__question" for="location">
            Your Great House
        </label>
        <select name="location" id="location" class="aboutMeForm__location" ></select>
        <?php if (isset($_SESSION['flags']['location']) && !$_SESSION['flags']['location']) { ?>
            <div class="errorMessage">Choose location.</div>
        <?php } ?>
        <label for="about-myself" class="aboutMeForm__question">
            Your preferences, hobbies, wishes, etc.
        </label>
        <textarea name="about-myself"
                  id="about-myself"
                  class="aboutMeForm__aboutMyself"
                  placeholder="I have long TOKILL list..."></textarea>
        <?php if (isset($_SESSION['flags']['about-myself']) && !$_SESSION['flags']['about-myself']) { ?>
            <div class="errorMessage">tell us about yourself!</div>
        <?php } ?>
        <input type="submit" value="Save" id="saveAboutMe" name="aboutMeSave" class="aboutMeForm__submitSave">
    </form>
</div>
<?php
unset($_SESSION['flags']);
unset($_SESSION['aboutMeForm']);
?>