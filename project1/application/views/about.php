<?php //echo $error; ?>
        </div>
        <section class="col-xs-10">
           <?php 
           if(isset($error)):?>
            <div class="row" style="margin-top: 15px">
              <div class="col-xs-12">
                <?php if($error=='match'): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Ошибка!</strong> Пароли не совпадают!
                </div>
              <?php endif ?>
              </div>
            </div>
            <?php endif ?>
         <div class="row">
           <div class="col-xs-12">
            <h3 class="page-header">Основная информация</h3>
            <form class="form-horizontal" action = "/settings/about" method="POST">
              <input name = "sendform" type="hidden" value = "form">
              <div class="form-group">
                <label class="control-label col-xs-2" for="lastName">Фамилия</label>
                <div class="col-xs-6">
                  <input name = "lastname" type="text" class="form-control" id="lastName" value = "<?php echo $lastname; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2" for="firstName">Имя</label>
                <div class="col-xs-6">
                  <input name = "firstname" type="text" class="form-control" id="firstName" value = "<?php echo $firstname; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2">Отчество</label>
                <div class="col-xs-6">
                 <input name = "middlename" type="text" class="form-control" id="firstName" value = "<?php echo $middlename; ?>" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2">Дата рождения</label>
                  <div class="col-xs-6">
                    <input name = "birthday" type="date" class = "form-control" value = "<?php echo $birthday; ?>">
                </div>
              </div>       
              <div class="form-group">
                <label class="control-label col-xs-2" for="inputEmail">Email</label>
                <div class="col-xs-6">
                  <input name = "email" type="email" class="form-control" id="inputEmail" value = "<?php echo $email; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2 ">Пол</label>
                <div class="col-xs-6">   
                <label>
                  <input type = "radio" value = "Женский" name = "gender" <?php if ($gender =="Женский") {echo "checked";}?>> Женский
                </label>      
                 <label>
                  <input type = "radio" value = "Мужской" name = "gender" <?php if ($gender =="Мужской") {echo "checked";}?>> Мужской
                 </label>        
                </div>
              </div>
              <h3 class="page-header">Дополнительно</h3>
              <div class="form-group">
                <label class="control-label col-xs-2" for="country">Страна</label>
                <?php //echo ?>
                <div class="col-xs-6">
                  <select name="country" id="country" class = "form-control">
                    <option selected disabled value="select">Выберите страну...</option>
                    <?php for($i=0; $i < max(count($countries),count($values)); $i++){
                      echo '<option value='.$values[$i];
                      if ($values[$i]==$country) echo ' selected';
                      echo '>'.$countries[$i].'</option>';
                    } 

                    ?>

                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2" for="city">Город</label>
                <div class="col-xs-6">
                  <select name="city" id="city" class = "form-control">
                    <option selected disabled value="select" class = "select">Выберите город...</option>
                    <?php for($i=0; $i < max(count($city_name),count($id_city),count($city_country)); $i++){
                      echo '<option class='.$city_country[$i].' value='.$id_city[$i]; 
                      if($id_city[$i]==$city) echo ' selected';
                      echo '>'.$city_name[$i].'</option>';
                    } 
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2" for="education">Образование</label>
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="education" name="education" value ="<?php echo $education ?>" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2" for="hobby">Хобби</label>
                <div class="col-xs-6">
                  <textarea style="resize:none;" name = "hobby" rows="2"class="form-control" id="hobby"><?php echo $hobby ?> </textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2">О себе</label>
                  <div class="col-xs-6">
                    <textarea style="resize:none;" name="about" rows="5" class = "form-control"><?php echo $about ?> </textarea>
                </div>     
              </div>
              <h3 class="page-header">Смена пароля</h3>
              <div class="form-group">
                <label class="control-label col-xs-2" for="country"> Новый пароль</label>
                  <div class="col-xs-6">
                    <input type="password" class = "form-control" name="password">
                  </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-2" for="city">Повторите пароль</label>
                <div class="col-xs-6">
                  <input type="password" class = "form-control" name="password-again">
                </div>
              </div>
              <div class="form-group">

                <div class="col-xs-offset-2 col-xs-3" style="margin-top:15px;">
                <input type="submit" class="btn btn-primary" value="Сохранить">
              </div>
            </form>
            <form action="/deleted/deleteact" style="position: absolute; margin-top: 15px" class = "col-xs-offset-6">
                <input type="submit" class="btn btn-danger" data-toggle='modal' data-target='#loginModal' value="Удалить профиль">
            </form>
          </div>  
          <form action="">
            
           <div class="form-group">
              <div class = "col-xs-2" style="margin: 10px">
                <a href = "/settings">Назад к настройкам</a>  
            </div>
           </div>
          </form>           
        </div>
    </section>
  </div>
</div>