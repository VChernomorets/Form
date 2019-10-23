<div class="aboutMeSection" id="aboutMe">
    <p class="alert">
        You've successfully joined the game.<br>
        Tell us more about yourself.
    </p>
    <form class="form aboutMeSection__form" action="handler.php" method="post">
        <label class="aboutMeForm__question" for="username">
            Who are you?
            <span class="aboutMeForm__hint">Alpha-numeric username</span>
        </label>
        <input type="text" class="aboutMeForm__text" id="username" placeholder="arya" name="username">
            <div class="errorMessage" id="username__error">Invalid username.</div>
        <label class="aboutMeForm__question" for="location">
            Your Great House
        </label>
        <select name="location" id="location" class="aboutMeForm__location" ></select>
            <div class="errorMessage" id="location__error">Choose location.</div>
        <label for="about-myself" class="aboutMeForm__question">
            Your preferences, hobbies, wishes, etc.
        </label>
        <textarea name="about-myself"
                  id="about-myself"
                  class="aboutMeForm__aboutMyself"
                  placeholder="I have long TOKILL list..."></textarea>
            <div class="errorMessage" id="about-myself__error">tell us about yourself!</div>
        <input type="hidden" name="aboutMeSave">
        <input type="submit" value="Save" id="saveAboutMe" name="aboutMeSave" class="aboutMeForm__submitSave">
    </form>
</div>
<?php
unset($_SESSION['flags']);
unset($_SESSION['aboutMeForm']);
?>