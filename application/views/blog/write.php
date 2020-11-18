

<!-- 提交给BS_Blog控制器的write方法 -->
<?= form_open('BS_Blog/writeSave'); ?>

	<label for="title">标题</label>
	<input type="input" name="title" /><br />

	<label for="content">内容</label>
	<textarea name="content"></textarea><br />

	<select name="tag">
		<?php foreach ($typeList as $type_item): ?>
			<option value="<?php echo $type_item['tid']; ?>">
				<?php echo $type_item['tid'].$type_item['name']; ?>
			</option>
		<?php endforeach; ?>
	</select>
	<input type="submit" name="submit" value="提交">
</form>
