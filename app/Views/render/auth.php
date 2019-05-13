<form action="/login" method="post">
    <input type="text" name="email" value="<?=$this->email ? $email : '';?>">
    <input type="text" name="password">
    <input type="submit" value="login">
</form>