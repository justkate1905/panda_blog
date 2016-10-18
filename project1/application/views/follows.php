
				</div>
                <section class="col-xs-10">
      <!--           	            <div class="col-xs-2" style = "padding: 0; width:11%">
                <p style=" text-align: center; margin:0px">
                    <img src="/img/panda-icon.png" alt="hello" class="img-circle" width="80" height="80" style = "margin: 0px;"> 
                </p>
                <p style = "margin: 0px">
                    <h3 class = "text-center" style=  "margin: 0px"><a href = "/profile/<?php echo $post->id_author;?>" class="btn btn-link" style = "valign: middle;" value = "<?php echo $post->id_author; ?>"><?php echo $post->login;?></a></h3>
                </p>
            </div> -->
                	<div class="row">
                		<?php $i=0;
                		$maxCount = max(count($follows), count($follows_id));
                		 for($i=0; $i<$maxCount; $i++){?>
                		 <div class="row">
                			<div class="col-xs-2 ">  
								<h4>
                				<span class="glyphicon glyphicon-heart" style = "margin-right:6px"></span>
									<a href = "/profile/<?php echo $follows_id[$i]; ?>"style = "valign: middle;" <?php echo 'value = '.$follows_id[$i]; ?> ><?php echo $follows[$i]; ?></a>
								</h4>
							</div>
                		 </div>
						<?php }?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
</div>