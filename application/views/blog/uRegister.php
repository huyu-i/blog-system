
<!-- 提交给BS_User控制器的uRegister方法 -->
<?= form_open('BS_User/uRegister'); ?>

	<label for="username">用户名</label>
	<input type="input" name="username" /><br />

	<label for="password">密码</label>
	<input type="input" name="password" /><br />

	<label for="email">邮箱</label>
	<input type="input" name="email" /><br />

	<label for="phone">电话</label>
	<input type="input" name="phone" /><br />

	<input type="submit" name="submit" value="注册" />

</form>

<a href="log_in">>>已有账号，直接登陆</a>
