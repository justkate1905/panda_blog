
		</div>
		<section class = "col-xs-10" style = "width: 80%">
		<?php if($error=='exist'): ?>
		<div class="row">
			
    		<div class="alert alert-danger alert-dismissible" role="alert" style = "margin-top: 15px; width: 98%">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right:0px"><span aria-hidden="true">&times;</span></button>
                <strong>Ошибка!</strong> Файл с таким именем уже сущесвтует!
          	</div>
		</div>
		<?php endif; ?>
		<p><h4>Фотографии</h4>
          <form action = "/photos" method = "POST" enctype = "multipart/form-data">
            <div class="form-group">
              <label for="exampleInputFile">Загрузите изображение</label></br>
              <input type="file" name = "userfile" id="exampleInputFile" accept = "image/x-png, image/jpeg">
            </div>
       <!--      <div class="checkbox">
              <label>
                <input type="checkbox"> Фотография загружена
              </label>
            </div> -->
            <button type="submit" class="btn btn-success">Загрузить</button>
          </form>
        </p>
        <?php 
        echo '<div class="row">';
        foreach ($path as $photo){
        	echo '<div class="col-md-3">
				    <a href="'.$photo->path.'" class="thumbnail" download  style="width:100%; height:238px">
				      <img src="'.$photo->path.'" alt=" :( >
				    </a>
        			<p class = "text-center"><a href="/photos/delete?id='.$photo->id.'"class="btn btn-danger btn-xs" role="button" value ="'.$photo->id.'">Удалить</a></p>
				  </div>';
        }
		echo '</div>';
        ?>
		</section>
	</div>
</div>
