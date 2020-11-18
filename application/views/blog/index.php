<table>
	<?php foreach ($blogs as $blog_item): ?>
	<tr>
		<td><?php echo $blog_item['title']; ?></td>
<!--		<td>--><?php //echo $blog_item['content']; ?><!--</td>-->
		<td>
			<?php echo '<a href="../BS_Blog/modifyLoad?bid='.$blog_item['bid'].'">编辑</a>' ?>
		</td>
		<td>
			<?php echo '<a href="../BS_Blog/deleteByBid?bid='.$blog_item['bid'].'">删除</a>' ?>
		</td>
		<td>
			<?php echo '<a href="../BS_Blog/showDetail?bid='.$blog_item['bid'].'">详情</a>' ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
