<!--=====================================
SLIDESHOW  
======================================-->

<?php $servidor = Ruta::ctrRutaServidor(); ?>

<div class="container-fluid" id="slide">
	
	<div class="row">
		
		<!--=====================================
		DIAPOSITIVAS
		======================================-->

		<ul>
		<?php  
			$controlador = new ControladorSlide();
			$slide = $controlador->ctrMostrarSlide();
		?>

			<!-- SLIDE 1 -->
			<?php foreach($slide as $key => $value) : ?>
			
				<li>
					<?php 
						$estilo = json_decode($value['estiloImgProducto'],true);
						$estiloTexto = json_decode($value['estiloTextoSlide'],true);
						$titulo1 = json_decode($value['titulo1'],true);
						$titulo2 = json_decode($value['titulo2'],true);
						$titulo3 = json_decode($value['titulo3'],true);
					?>
					<img src="<?=$servidor?><?=$value['imgFondo']?>">

					<div class="slideOpciones <?=$value['tipoSlide']?>">
					<?php if($value['imgProducto'] != 'vacio') : ?>
						<img class="imgProducto" src="<?=$servidor?><?=$value['imgProducto']?>" style="top:<?=$estilo['top']?>; right:<?=$estilo['right']?>; width:<?=$estilo['width']?>; left:<?=$estilo['left']?>;">
					<?php endif ?>
						<div class="textosSlide" style="top:<?=$estiloTexto['top']?>; right:<?=$estiloTexto['right']?>; width:<?=$estiloTexto['width']?>; left:<?=$estiloTexto['left']?>;">
							
							<h1 style="color:<?=$titulo1['color']?>"><?=$titulo1['texto']?></h1>
							<h2 style="color:<?=$titulo1['color']?>"><?=$titulo1['texto']?></h2>
							<h3 style="color:<?=$titulo1['color']?>"><?=$titulo1['texto']?></h3>

							<a href="<?=$value['url']?>">
								
								<?=$value['boton']?>

							</a>

						</div>	

					</div>

				</li>	
			<?php endforeach ?>

			
		</ul>

		<!--=====================================
		PAGINACIÓN
		======================================-->

		<ol id="paginacion">

		<?php for($i = 1; $i<=count($slide); $i++): ?>

        	<li item="<?=$i?>"><span class="fa fa-circle"></span></li>
		<?php endfor ?>
		</ol>	

		<!--=====================================
		FLECHAS
		======================================-->	

		<div class="flechas" id="retroceder"><span class="fa fa-chevron-left"></span></div>
		<div class="flechas" id="avanzar"><span class="fa fa-chevron-right"></span></div>

	</div>

</div>

<center>
	
	<button id="btnSlide" class="backColor">
		
			<i class="fa fa-angle-up"></i>

	</button>

</center>