<h2><?php echo $title; ?></h2>

<!-- 提交给login控制器的create方法 -->
<?= form_open('login/create'); ?>

	<label for="name">姓名</label>
	<input type="input" name="name" /><br />

	<label for="password">密码</label>
	<input type="input" name="password" /><br />

	<label for="dept_id">部门</label>
	<input type="input" name="dept_id" /><br />

	<label for="notes">备注</label>
	<textarea name="notes"></textarea><br />

	<input type="submit" name="submit" value="创建用户" />

</form>
