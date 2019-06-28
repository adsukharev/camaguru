
<div class="container profile">

    <div class="form signUp">
        <h3>Modify your Profile</h3>
        <h4>change all or just one input</h4>
        <form name="SignUp" action="/profile/modify" method="post">
            <input type=text name="email" value='' placeholder="email" minlength="3" maxlength="30"
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example@mail.ru">
            <br>
            <input type=text name="login" value='' placeholder="login" minlength="3" maxlength="15">
            <br>
            <input type=text name="pass" value='' placeholder="password" minlength="3" maxlength="15">
            <br>
            <input type=checkbox id="notification" name="notification" placeholder="password" checked>
            <label for="notification">Notification </label>
            <br>
            <input type="hidden" name="csrf" value="<?php echo $data?>">
            <button name="modify" value="ok">Modify</button>
        </form>
    </div>

</div>