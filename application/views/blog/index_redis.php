<?= form_open('RedisController/redis_login') ?>

	<label for="email">邮箱</label>
	<input type="input" name="email" /><br />

	<label for="password">密码</label>
	<input type="password" name="password" /><br />

	<button name="submit" type="submit" >登陆</button>

</form>
