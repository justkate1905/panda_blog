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