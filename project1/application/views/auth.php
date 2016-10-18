<body class = "begin">
<div class="container ">
	<div class="row">
		<div class="col-xs-12">
			<a href="/"><img src="/img/panda-blog1.png" alt="Whitesquare logo" style = "margin-top: 10px;"></a>
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
    	<?php else: ?>
    	<div class="alert alert-danger alert-dismissible" role="alert">
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          	<strong>Ошибка!</strong> Неверно указан пароль и/или логин!
        </div>
    	<?php endif ?>
      </div>
    </div>
  	<?php endif ?>
	<div class="row">
		<div class="col-xs-7">	
		</div>
		<div class="col-xs-5">
			<h3 class = "page-header contr">Добро пожаловать!</h3>
			<form class="form-horizontal" action = "/auth" method="POST">
				<input type="hidden"  name="sign" value="true">
		 		<div class="form-group">
		    		<label for="inputlogin" class="col-sm-2 control-label contr">Логин</label>
		    		<div class="col-sm-9">
		      			<input type="text" class="form-control" id="inputlogin" name = "login">
		    		</div>
		  		</div>
		  		<div class="form-group">
		    		<label for="inputPassword" class="col-sm-2 control-label contr">Пароль</label>
		    		<div class="col-sm-9">
		      			<input type="password" class="form-control" id="inputPassword" name = "pass">
		    		</div>
		  		</div>
		 		<div class="form-group">
		    		<div class="col-sm-offset-2 col-sm-10">
		      			<button type="submit" class="btn btn-default" style="margin-bottom: 20px">Войти</button>
		    		</div>
		  		</div>
			</form>
			<form action = "/reg">
				<button class = 'btn btn-default' style="position: absolute; right: 160px;bottom: 0; margin-bottom: 35px;">Регистрация</button>
			</form>
		</div>
	</div>
</div>