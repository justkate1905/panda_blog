    </div>
    <div class="row">
    <?php 
    foreach($news as $post){
                $date =  $post->public_date; 
                $datenew = new DateTime($date);
                    echo '<div class="row" style = "margin-bottom:20px">';
           echo '<div class="col-xs-2" style = "width: 11%">';
            echo '<p style=" text-align: center;  margin: 0px">';
             echo '<img src="'.$post->profile_photo.'" alt="hello" class="img-circle" width="80" height="80" style = "margin: 0px;"> </p>';
            echo '<h3 class = "text-center"  style = "margin:0px"><a href = "/profile/'.$post->id_user.'" class="btn btn-link" style = "valign: middle;" value = "'.$post->id_user.'">'.$post->login.'</a></h3>';
              echo '</div>';
            echo '<div class="col-xs-10 well" style = "width: 86%">';
                    echo '<div class="col-xs-10">'.$post->post.'</div>';
                    echo '<div class="col-xs-2">';              
                        echo "<time datetime=" . $date. " pubdate>" . $datenew->format('j.m.o, H:i') . '</time>';
                echo '</div>';
        echo '</div>';  
        echo '</div>';
    }
    ?>
</div>
</div>