<?php echo validation_errors(); ?>

<?= form_open('login/log_in') ?>

	<label for="id">用户ID</label>
	<input type="input" name="id" /><br />

	<label for="password">密码</label>
	<input type="input" name="password" /><br />

	<input type="submit" name="submit" value="登陆" />

</form>
