
        </div>
        <section class="col-xs-10">
         <div class="row">
           <div class="col-xs-12">
            <h3 class="page-header">Основная информация</h3>
            <form class="form-horizontal" action = "/settings/save" method="POST">
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Фамилия</strong></span>
                <div class="col-xs-6">
                  <?php echo $lastname; ?>
                </div>
              </div>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Имя</strong></span>

                <div class="col-xs-6">
                  <?php echo $firstname; ?>
                </div>
              </div>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Отчество</strong></span>
                <div class="col-xs-6">
                 <?php echo $middlename; ?>
                </div>
              </div>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Дата рождения</strong></span>
                  <div class="col-xs-6">
                    <?php echo $birthday; ?>
                </div>
              </div>       
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Email</strong></span>

                <div class="col-xs-6">
                  <?php echo $email; ?>
                </div>
              </div>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Пол</strong></span>

                <div class="col-xs-6">         
                  <?php echo $gender;?>
                </div>
              </div>
              <h3 class="page-header">Дополнительно</h3>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Страна</strong></span>
                                <?php //echo ?>
                <div class="col-xs-6">
                    <?php for($i=0; $i < max(count($countries),count($values)); $i++){
                      if ($values[$i]==$country)
                      echo $countries[$i];
                    } 
                    ?>
                </div>
              </div>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Город</strong></span>                
                <div class="col-xs-6">
                    <?php for($i=0; $i < max(count($city_name),count($id_city),count($city_country)); $i++){
                      if($id_city[$i]==$city)
                      echo $city_name[$i];
                    } 
                    ?>
                </div>
              </div>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Образование</strong></span>                

                <div class="col-xs-6">
                  <?php echo $education ?>
                </div>
              </div>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>Хобби</strong></span>                

                <div class="col-xs-6">
                  <?php echo $hobby ?>
                </div>
              </div>
              <div class="form-group">
                <span class = "col-xs-2 text-right"><strong>О себе</strong></span>                

                  <div class="col-xs-6">
                   <?php echo $about ?>
                </div>     
              </div>   
            <a href='/profile/<?php echo $id; ?>' style = "margin: 6px"> Назад к записям</a>
            </form>
          </div>             
        </div>
    </section>
  </div>
</div>