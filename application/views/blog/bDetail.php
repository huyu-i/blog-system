
<input type="hidden" name="bid" value="<?php echo $blog['bid'] ?>"/>

<label for="title">标题</label>
<input type="input" name="title" disabled value="<?php echo $blog['title'] ?>" /><br />

<label for="content">内容</label>
<textarea name="content" disabled ><?php echo $blog['content'] ?></textarea><br />

<?php echo '<a href="../BS_Blog/getByUid">>>返回列表</a>' ?>

