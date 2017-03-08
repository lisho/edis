<?php
	
	$tecnico = '';
	$tecnico_completo = 'Pendiente';
	$i = 0;
	foreach ($roles as $rol){

		if ($rol['rol'] == 'tedis') {

			$tecnico_completo = $rol['tecnico']['nombre'].' '.$rol['tecnico']['apellidos'];
//debug($tecnico_completo);exit();
			switch ($tecnico_completo){
				CASE 'Luis Alberto Gonzalez Gomez':
					$tecnico = 'LI';
					break;

				CASE 'Helena Marsá Navarro':
					$tecnico = 'HE';
					break;

				CASE 'Rosaura Sanchez Bodega':
					$tecnico = 'RO';
					break;

				CASE 'Maria Nieves Álvarez Castañeda':
					$tecnico = 'NI';
					break;

				CASE 'Maria Mercedes Marne Nicolás':
					$tecnico = 'ME';
					break;

				CASE 'María Ángeles Arias García':
					$tecnico = 'MA';
					break;
				defult:
					$tecnico = 'PEND';
					break;
			}

		
		$mensaje = 'Expediente asignado a '.$tecnico_completo;
		echo $this->Html->link($tecnico, 'javascript:;', [     
                            'class'=> 'label label-primary circulo',
                            'id'=>$rol->id.$mod,
                            //'data-expediente' => $pasacomision->expediente->id,
                            'data-container'=>"body",
                            'data-toggle'=>"popover",
                            'data-placement'=>"top",
                            'data-content'=> $mensaje]);
        }                    
	} //--> END Foreach

	if($tecnico_completo == 'Pendiente'){

		$tecnico = 'PEND.';
		$mensaje = 'Expediente Pendiente de Asignar';
		echo $this->Html->link($tecnico, 'javascript:;', [     
                            'class'=> 'label label-danger circulo',
                            'id'=>$i++,
                            //'data-expediente' => $pasacomision->expediente->id,
                            'data-container'=>"body",
                            'data-toggle'=>"popover",
                            'data-placement'=>"top",
                            'data-content'=> $mensaje]);
		}

?>