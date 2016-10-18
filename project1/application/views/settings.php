
			</div>
			<section class="col-xs-10">
						<div class="row">
							<div class="col-xs-10">
								<div class="well">
									</br>
									<div class="col-xs-1">
										<p>
											<h4><i class="glyphicon glyphicon-user"></i></h4>
										</p>
									</div>
									<a tabindex="-1" href="/settings/about"><h4>Информация</h4></a>
									<hr>
									</br>
									<div class="col-xs-1">
										<p>
											<h4><i class="glyphicon glyphicon-picture"></i></h4>
										</p>
									</div>
									<a tabindex="-1" href="/settings/photo"><h4>Фото</h4></a>
									<hr>
									</br>
								</div>
								<?php if($status == 1){
									echo '<a href="/admin">К администрированию</a>';
								}
								 ?>
							</div>
						</div>
			
			</section>
		</div>
	</div>
</div>