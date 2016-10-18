
<script type = "text/javascript">
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
</script>

    </div>

<!--         </div> -->
        <section class="col-xs-10">
        
        <?php 
        foreach($posts as $post){
            $date = $post->public_date; 
            $datenew = new DateTime($date);
        ?>    
        <div class = "row" style = "margin-bottom:20px">
            <div class="col-xs-2" style = "padding: 0; width:11%">
                <p style=" text-align: center; margin:0px">
                    <?php echo '<img src="'.$post->profile_photo.'" alt="hello" class="img-circle" width="80" height="80" style = "margin: 0px;">'; ?> 
                </p>
                <p style = "margin: 0px">
                    <h3 class = "text-center" style=  "margin: 0px"><a href = "/profile/<?php echo $post->id_author;?>" class="btn btn-link" style = "valign: middle;" value = "<?php echo $post->id_author; ?>"><?php echo $post->login;?></a></h3>
                </p>
            </div>
            <div class="col-xs-10" data-post="$post_id"  style = "width:86%">
                <div class="row well" >
                    <div class="row">
                        <div class="col-xs-9" style = "width:80%"> <?php echo $post->post; ?>
                        </div>
                        <div class="col-xs-3" style = "width: 20%">              
                            <time datetime="' . $date. '" pubdate> <?php echo $datenew->format('j.m.o, H:i'); ?> </time>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2" style="margin-top: 12px">
                        <?php
                            echo '<button id = "button" type="button" class="btn';
                                if(in_array($post->id_post, $fav)){
                                    echo ' btn-warning js-favourited"';
                                }
                                else{ 
                                    echo ' btn-default js-favourite"';
                                }
                                echo 'data-post = "'.$post->id_post.'" data-toggle="tooltip" data-placement="bottom" style="margin-left: 7px" title="Добавить в избранное">';
                                echo '<span id = "span" class="glyphicon';
                                if(in_array($post->id_post, $fav)){
                                    echo ' glyphicon-star"';
                                }
                                else{ 
                                    echo ' glyphicon-star-empty"';
                                }
                                echo 'aria-hidden="true"></span>';
                                echo '</button>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    }
        ?>
        </section>
    </div>
</div>