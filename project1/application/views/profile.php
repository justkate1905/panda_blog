<body class = "white-back">
<?php

/**
 * Выводит пост или комментарий
 * 
 * @param object $objPostInfo - объект с информацией об посте
 * @param bool $isComment - true  - выводим комметарий, false - пост
 * @param object $objComments - объект комметариев для поста
 */
function showPost($actId, $status, $id_user, $favArray, $objPostInfo, $isComment = false, $objComments = null) {
		$id = $objPostInfo->id;
		$date = $objPostInfo->public_date;
		$datenew = new DateTime($date);
		if ($isComment) $text = isset($objPostInfo->comment) ? $objPostInfo->comment : '';
		else $text = $objPostInfo->post;

		if ($isComment) echo '<div class="comment" style="margin-left: 30px;">';
		echo '<div class = "row well posts" style = "margin-bottom:10px; width:99%	" data-post-id="' . $id . '">';
			echo '<div class="row">';
				echo '<div class="col-xs-9" style = "width: 76%">' . $text . '</div>';
				echo '<div class="col-xs-2" style = "width: 16%">';				
			 		echo "<time datetime=" . $date . " pubdate>" . $datenew->format('j.m.o, H:i') . "</time>"; 
				echo '</div>';
				//if($status==1 || ($actId==$id_user)){
				echo '<div class="col-xs-1" style = "width: 8%">';
					echo '<button type="button" class="btn btn-danger js-delete' . ($isComment ? ' comment' : ' ') . '" data-post = "' . $id . '" data-toggle="tooltip" data-placement="bottom" style="margin-left: 10px" title="Удалить">';
						echo '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
					echo '</button>';
				echo '</div>';
			//}
			echo '</div>';

			echo '<div class="row">';
				echo '<div class="col-xs-2" style="margin-top: 12px">';
					
						if (!$isComment) {
							echo '<button type="button" class="btn btn-default js-comment" data-toggle="tooltip" data-placement="bottom" title="Комментарии">';
								echo '<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>';
							echo '</button>';
						echo '<button id = "button" type="button" class="btn';
						if(in_array($id, $favArray)){
							echo ' btn-warning js-favourited"';
						}
						else{ 
							echo ' btn-default js-favourite"';
						}
						echo 'data-post = "' . $id . '" data-toggle="tooltip" data-placement="bottom" style="margin-left: 7px" title="Добавить в избранное">';
							echo '<span id = "span" class="glyphicon';
						if(in_array($id, $favArray)){
							echo ' glyphicon-star"';
						}
						else{ 
							echo ' glyphicon-star-empty"';
						}
							echo 'aria-hidden="true"></span>';
						echo '</button>';
						}	
					
				echo '</div>';					
			echo '</div>';
		echo '</div>';
		if ($isComment) echo '</div>';
		if ($objComments) foreach($objComments as $objComment) showPost($actId, $status, $id_user, $favArray,$objComment, true);
}

?>


<script type="text/javascript" >
		$("body").on("click", ".js-favourite", function(){
			$.post('/posts/setFavourite', {id_post: $(this).data('post')
			}, function(data){
			    console.log(data);
					if(data['result']='ok'){
					span.className = 'glyphicon glyphicon-star'
					button.className = 'btn btn-warning js-favourited'
				}
			}, 'json');
			location.reload(true);
		});

		$("body").on("click",'.js-favourited', function(){
			$.post('/posts/unsetFavourite', {id_post: $(this).data('post')
			}, function(data){
					if(data['result']='ok'){
					span.className = 'glyphicon glyphicon-star-empty'
					button.className = 'btn btn-default js-favourite'
				}
			}, 'json');
			location.reload(true);
		});

	$(function(){
		$(".js-delete").on("click", function(){
			var button = $(this);
			var type;
			if (button.hasClass('comment')) type = 'comment';
			else type = 'post';
			$.post('/posts/deletePost',{id_post: $(this).data('post'), type: type
			}, function(data){
				console.log(data);
				if(data['result'] =='ok'){
					console.log(button.closest('.posts'));
					if (type == 'comment') 
						button.closest('.posts').remove();
					else button.closest('.post-comment').remove();
				}
				else{
					if (type == 'comment') 
						alert('Вы пытаетесь удалить чужой комментарий!');
					else alert('Вы пытаетесь удалить чужой пост!');
				}
					
			},'json')
		});

		/**
		 * Событие на клик по кнопки отправить комментарий(тут ппц, фактически ajax запрос, но получаем целую верстку страницы.
		 * Хорошо бы получать вообще только блок с комментарием)
		 */
		$('body').on('click', '.js-send-comment', function(){
			var postData = $(this).parent().serializeArray();
			$.post('/add?type=comment', postData, function(data){
					if(data['result']='ok'){
				// 	span.removeAttribute("class");
				// 	span.setAttribute("class", "glyphicon glyphicon-star-empty")
				// 	button.removeAttribute("class");
				// 	button.setAttribute("class","btn btn-default js-favourite")
				}
			}, 'json');
			location.reload(true);
		});
		
		/**
		 * Обрабатывает событие клика на "Подписаться"
		 * 
		 */
		$('body').on('click', '.js-follower', function(){
			var followerID = $(this).val();
			$.post('/profile/addFollow', {follower_id: followerID}, function(data){
									
			}, 'json');
			// if ($(this).hasClass('btn-success')) alert('Вы подписались на человека');
			// else alert('Вы отписались от человека');
			location.reload(true);
		});
		
		/**
		 * Отображает форму для ввода комментария
		 */
		$(".js-comment").on("click", function(){
			var postID = $(this).parents('.posts').data('post-id');
			var html = '';
			html += '<div class="comment" style = "margin-top: 15px">';
				html += '<form  method="POST">';
					html += '<textarea name="comment" class="form-control" rows="3" placeholder="Написать текст..."></textarea>';
					html += '<input type="hidden" value="' + postID + '" name="post_id">';
					html += '<input class="btn btn-success js-send-comment" style="margin-top: 10px;" value="Отправить" type="button">';
				html += '</form>';
			html += '</div>';
					
			$(this).parents('.posts').append(html);			
		});
	})
</script>

<div class="wrapper container">
<div class="row">
	
<nav class="navbar navbar-default navbar-inverse ">
	<ul class="nav navbar-nav">
		<li><a href="/main"><img src="/img/panda-blog1.png" alt="Whitesquare logo" style="padding: 0 0 0 0; height: 21px;"></a></li> 
		<li><a href="/main">Главная</a></li>
		<li><a href="/profile">Профиль</a></li>
		<li><a href="/profile/favourites">Избранное</a></li>
		<li><a href="/profile/follows">Подписки</a></li>
		            <li><a href="/profile/news">Лента</a></li>
            <li><a href="/photos">Фото</a></li>
		<li><a href="/settings">Настройки</a></li>

	<?php
		if($actId!=$user_id){
	echo '<li><a href="/about?url='.$user_id.'">Информация</a></li>';
		}
	?>
	</ul>
				<ul class="nav navbar-nav navbar-right">
			<!-- <li><a href="/profile/logout">Выход</a></li> -->
      <li><a href="/profile/logout" style = "margin-right:15px">Выход</a></li>

          </ul>
</nav>
<p style = "margin-top: 20px">
	<div class="heading">
	</div>
	<div class="row">
		<div class="col-xs-2">
		<aside class="left_side" style=" text-align: center">
			<p style=" text-align: center">
			<?php echo '<img src="'.$prof_photo.'" alt="hello" class="img-circle" width="140" height="140" style = "margin-top: 0px;"> </p>'; ?>
			<p style = "margin-top: 15px">
				<?php 
					echo "<h3 class = 'text-center'>" . $login . "</h3>";
				?>
				<?php
					if($actId!=$user_id){
				echo '<button type="submit" class="btn ' . (!$is_follower ? 'btn-success' : 'btn-error') . ' js-follower" style = "margin-top: 10px;" value="' . $user_id . '">' . ($is_follower ? 'Отписаться' : 'Подписаться') . '</button>';
				}
				?>
			</p>
		</aside>
		</div>
		<section class="col-xs-10">
			<?php if($actId==$user_id){echo '
						<div class="row">
				<form action = "/add?type=post" method = "POST">
					<textarea name = "blog" class="form-control" id = "postInput" rows="5" style = "resize: none; width: 97%" placeholder = "Написать текст..."></textarea>
					<button type="submit" class="btn btn-success" style = "margin-top: 10px;">Добавить запись</button>
				</form>
			</div>
			';}?>
			<?php 
				foreach($blog as $post){
					echo '<div class="post-comment">';						
					showPost($actId, $status, $user_id, $fav, $post['post'], false, $post['comments']);
					echo '</div>';
				}
			?>			
		</section>
	</div>
</div>
</div>

