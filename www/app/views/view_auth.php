<div class="container auth">

    <?php if (!isset($_GET["forgotPass"])): ?>
        <div class="form signIn">
            <h3>SignIn</h3>
            <form name="SignIn" action="/auth/signIn" method="post">
                <input type=text name="login" value='' placeholder="login" required minlength="3" maxlength="15">
                <br>
                <input type=password name="pass" value='' placeholder="password" required minlength="3" maxlength="15">
                <br>
                <input style="visibility: hidden">
                <br>
                <a href="/auth?forgotPass=1" style="color: white">Reset password</a>
                <br>
                <button name="SignIn" value="ok">SignIn</button>
            </form>
        </div>

        <div class="form signUp">
            <h3>SignUp</h3>
            <form name="SignUp" action="/auth/signUp" method="post">
                <input type=email name="email" value='' placeholder="email" required minlength="3" maxlength="30"
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example@mail.ru">
                <br>
                <input type=text name="login" value='' placeholder="login" required minlength="3" maxlength="15">
                <br>
                <input type=password name="pass" value='' placeholder="password" required minlength="3" maxlength="15">
                <br>
                <br>
                <button name="SignUp" value="ok">SignUp</button>
            </form>
        </div>

    <?php else: ?>
        <div class="form signIn">
            <h3>Reset password</h3>
            <form name="forgotPass" action="/auth/forgotPass" method="post">
                <input type=email name="email" value='' placeholder="email" required minlength="3" maxlength="30"
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example@mail.ru">
                <button name="forgotPass" value="ok">Reset</button>
            </form>
        </div>
    <?php endif; ?>
</div>