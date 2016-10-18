<body class = "begin">
<div class="container ">
	<div class="row">
		<div class="col-xs-12">			
			<header>
				<a href="/"><img src="img/panda-blog1.png" alt="Whitesquare logo" style = "margin-top: 10px;"></a>
			</header>
		</div>
	</div>
		<?php //echo $error;
    if(isset($error)): ?>
    <div class="row" style="margin-top: 15px">
    	<div class="col-xs-12">
    		<?php if($error=='empty'): ?>
    		<div class="alert alert-danger alert-dismissible" role="alert">
    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			<strong>Ошибка!</strong> Заполните все поля формы!
    		</div>
    	<?php else:  ?>
    	    <div class="alert alert-danger alert-dismissible" role="alert">
    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			<strong>Ошибка!</strong> Такой логин уже существует!
    		</div>
    	<?php endif ?>
      </div>
    </div>
  	<?php endif ?>
	<div class="row">
		<div class="col-xs-7">	
		</div>
		<div class="col-xs-5">
			<h3 class = "page-header contr">Регистрация</h3>
			<form class="form-horizontal" action = "/reg" method = "POST">
				<input type="hidden"  name="send_form" value="true">
				<div class="form-group">
					<label for="inputlogin" class="col-sm-2 control-label contr">Логин<sup>*</sup></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputLogin" name="login">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail" class="col-sm-2 control-label contr">E-mail<sup>*</sup></label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="inputEmail" name="email">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="col-sm-2 control-label contr">Пароль<sup>*</sup></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword" name="pass">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default" style="margin-bottom: 20px">Зарегистрироваться</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
