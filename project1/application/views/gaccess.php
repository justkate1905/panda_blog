<body class = "white-back">
<?php

/**
 * Выводит пост или комментарий
 * 
 * @param object $objPostInfo - объект с информацией об посте
 * @param bool $isComment - true  - выводим комметарий, false - пост
 * @param object $objComments - объект комметариев для поста
 */
function showPost($objPostInfo, $isComment = false, $objComments = null) {
		$id = $objPostInfo->id;
		$date = $objPostInfo->public_date;
		$datenew = new DateTime($date);
		if ($isComment) $text = isset($objPostInfo->comment) ? $objPostInfo->comment : '';
		else $text = $objPostInfo->post;

		if ($isComment) echo '<div class="comment" style="margin-left: 30px;">';
		echo '<div class = "row well posts" style = "margin-bottom:10px;	" data-post-id="' . $id . '">';
			echo '<div class="row">';
			echo '<div class = col-xs-12>';
				echo '<div class="col-xs-10">' . $text . '</div>';
				echo '<div class="col-xs-2">';				
			 		echo "<time datetime=" . $date . " pubdate>" . $datenew->format('j.m.o, H:i') . "</time>"; 
				echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		if ($isComment) echo '</div>';
		if ($objComments) foreach($objComments as $objComment) showPost($objComment, true);
}

?>
<!-- <div class="wrapper container">
<div class="row">
	
<nav class="navbar navbar-default navbar-inverse ">
	<ul class="nav navbar-nav">
		<li><a href="/profile"><img src="/img/panda-blog1.png" alt="Whitesquare logo" style="padding: 0 0 0 0; height: 21px;"></a></li> 
		<li><a href="/profile">Главная</a></li>
		<li><a href="/profile/favourites">Избранное</a></li>
		<li><a href="/profile/follows">Подписки</a></li>
		            <li><a href="/profile/news">Лента</a></li>
            <li><a href="/profile/photos">Фото</a></li>
		<li><a href="/settings">Настройки</a></li>
	</ul>
</nav> -->

		</div>
		<section class="col-xs-10">
			<?php 
				foreach($blog as $post){
					echo '<div class="post-comment">';						
					showPost($post['post'], false, $post['comments']);
					echo '</div>';
				}
			?>			
		</section>
	</div>
</div>
</div>

