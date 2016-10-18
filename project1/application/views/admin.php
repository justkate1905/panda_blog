
<body class = "white-back">
  <script>
  $(function(){
    $(".js-delete-user").on("click",function(){
      var id = $(this).data('user')
      $("tr[id='"+id+"']").remove()
      $.post('/deleted/delete', {id_user: $(this).data('user')},
        function(data){
        
      },"json")
    })
  })

  </script>
    <div class="container">
      <div class = "row">
        <div class = "col-xs-12">
          <h3 class = "page-header">Пользователи <small></small> </h3>
          <table class = "table">
            <thead>
              <tr>
                <th>Логин</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Время последней активности</th>
                <th>Период неактивности</th>
                <th>Привилегии</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $max = max(count($login),count($firstname),count($lastname),count($middlename),count($activity_date),count($period), count($id));
              for($i=0; $i<$max; $i++){
                    $date = $activity_date[$i];
                    $datenew = new DateTime($date);
              echo "<tr id = ".$id[$i].">
                <td>".$login[$i]."</td>
                <td>".$lastname[$i]."</td>
                <td>".$firstname[$i]."</td>
                <td>".$middlename[$i]."</td>
                <td>".$datenew->format('j.m.o')."</td>
                <td>".round($period[$i]/3600,2)." ч. </td>
                <td>";
                if ($privileges[$i]==1)
                  echo "Администратор";
                else 
                  echo "Пользователь";
                echo "</td>
                <td>";
                if($id[$i]!=$actid){
                  echo '<button type="button" class="btn btn-danger js-delete-user" id="'.$id[$i].'" data-user = "' . $id[$i] . '" data-toggle="tooltip" data-placement="bottom" style="margin-left: 10px" title="Удалить">';
            echo '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
          echo '</button>';}
          echo "</td>
                </tr>";
              } ?>
            </tbody>
          </table> 
        </div>
      </div>
    </div>
       <div class="container">  
    <div class="row">
      <div class="col-xs-12">
              <a href = "/profile">К профилю</a>
      </div>
    </div>
   </div>