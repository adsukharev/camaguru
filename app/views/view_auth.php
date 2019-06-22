
<div class="container auth">

    <div class="form signIn">
        <h3>SignIn</h3>
        <form name="SignIn" action="/auth/signIn" method="post">
            <input type=text name="login" value='' placeholder="login" required minlength="3" maxlength="10">
            <br>
            <input type=text name="pass" value='' placeholder="password" required minlength="3" maxlength="10">
            <br>
            <input style="visibility: hidden">
            <br>
            <button name="SignIn" value="ok">SignIn</button>
        </form>
    </div>

    <div class="form signUp">
        <h3>SignUp</h3>
        <form name="SignUp" action="/auth/signUp" method="post">
            <input type=text name="email" value='' placeholder="email" required minlength="3" maxlength="20"
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example@mail.ru">
            <br>
            <input type=text name="login" value='' placeholder="login" required minlength="3" maxlength="10">
            <br>
            <input type=text name="pass" value='' placeholder="password" required minlength="3" maxlength="10">
            <br>
            <button name="SignUp" value="ok">SignUp</button>
        </form>
    </div>

</div>
