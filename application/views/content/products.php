<script type="text/javascript">
		$(document).ready(function(){
			$('div.spoiler_body').hide();
			$('.spoiler_links').click(function(){
			$(this).toggleClass('opened').parent().children('div.spoiler_body').toggle('normal');
			if($(this).hasClass('opened')) {
	$(this).html('Свернуть').append('<span></span>');}
  else {
	$(this).html('Развернуть').append('<span></span>');}
			return false;
			});		
		});
</script>

<div class="production_wrap">
					<nav id="inner_menu">
						<ul>
							<li><a href="#" title="Прецизионные кондиционеры">Прецизионные кондиционеры</a></li>
							<li><a href="#" title="Чиллеры">Чиллеры</a></li>
							<li><a href="#" title="Оборудование для telecom">Оборудование для telecom</a></li>
							<li><a href="#" title="Фальшпол">Фальшпол</a></li>
						</ul>
					</nav>
					<div class="collapse_wrap">
                        <?foreach($category as $row){?>
						<section>
							<div class="header_section">
								<div class="head_image">
									<img src="/image/img_1.jpg" alt="">
								</div>
								<div class="head_desc">
									<span><h2><a style="color: #565656;" href="/products/<?=$row['cat']->link?>.html"><?=$row['cat']->name?></a></h2></span>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam hendrerit vehicula libero sit amet feugiat. Etiam eget pharetra arcu, at semper sem. Nulla lorem lacus, viverra ac magna non, congue cursus sem. Suspendisse id enim mi. Etiam pulvinar orci dui, ac eleifend justo ornare congue. </p>
								</div>
								<div class="clear"></div>
							</div>
                            <?if(!empty($row['podcat'])){?>
							<div class="spoiler_body" style="display: none;">
								<ul class="block">
                                    <?foreach($row['podcat'] as $podcat){?>
									<li>
										<div class="head_image">
											<img src="/image/img_1.jpg" alt="">
										</div>
										<div class="head_desc">
											<h2><?=$podcat->name?></h2>
                                            <p style="margin-left: 20px;"><?=$podcat->text?></p>
										</div>
									</li>
                                    <?}?>
								</ul>
							</div>
							<div class="spoiler_links">Развернуть<span></span></div>
                            <?}?>
						</section>
                        <?}?>
					</div>
				</div>