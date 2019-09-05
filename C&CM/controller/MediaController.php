<?php
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class MediaController extends ControladorBase{
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->view("gallery",array(
            "title"    =>"Galería de archivos."
        ));
    }

    public function up_file(){
        $this->view("up_file",array(
            "title"    =>"SAC - Bandeja de entrada"
        ));
    }

	function randomColor(){
		return mt_rand(0, 255);
	}

    public function image_text(){
  		$this->get['w'] = (isset($this->get['w']) && $this->get['w'] != '') ? $this->get['w'] : 240;
  		$this->get['h'] = (isset($this->get['h']) && $this->get['h'] != '') ? $this->get['h'] : 240;
  		$this->get['txt_input'] = (isset($this->get['txt_input']) && $this->get['txt_input'] != '') ? $this->get['txt_input'] : '☺';
  		$img = imagecreate($this->get['w'], $this->get['h']);

  		$textbgcolor = imagecolorallocate($img, $this->randomColor(), $this->randomColor(), $this->randomColor());
  		$textcolor = imagecolorallocate($img, $this->randomColor(), $this->randomColor(), $this->randomColor());
  		$exploreTxt = explode(' ', $this->get['txt_input']);

  		$txt = $this->get['txt_input'];
  		if($txt == 'application/pdf'){
  			$im = sprintf('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTYgNTYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU2IDU2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHN0eWxlIHR5cGU9InRleHQvY3NzIj4uc3Qwe2ZpbGw6I0UyNTc0Qzt9LnN0MXtmaWxsOiNCNTM2Mjk7fS5zdDJ7ZmlsbDojRkZGRkZGO308L3N0eWxlPjxnPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zNi45LDBoLTI5QzcuMiwwLDYuNCwwLjYsNi40LDEuOVY1NWMwLDAuNCwwLjYsMSwxLjUsMWg0MC4xYzAuNywwLDEuNS0wLjYsMS41LTFWMTNjMC0wLjctMC4xLTAuOS0wLjMtMS4xTDM3LjcsMC4zQzM3LjQsMC4xLDM3LjIsMCwzNi45LDBMMzYuOSwweiIvPjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik0zNy40LDAuMVYxMmgxMS45TDM3LjQsMC4xeiIvPjxwYXRoIGNsYXNzPSJzdDIiIGQ9Ik0xNy4zLDM0LjNoLTEuNlYyNC4xaDIuOWMwLjQsMCwwLjksMC4xLDEuMiwwLjNjMC40LDAuMSwwLjcsMC40LDEuMSwwLjZjMC40LDAuMywwLjYsMC42LDAuNywxYzAuMywwLjQsMC4zLDAuOSwwLjMsMS4yYzAsMC41LTAuMSwxLTAuMywxLjRjLTAuMSwwLjQtMC40LDAuNy0wLjcsMWMtMC4zLDAuMy0wLjYsMC41LTEuMSwwLjZjLTAuNCwwLjEtMC45LDAuMy0xLjUsMC4zaC0xLjN2My44SDE3LjN6IE0xNy4zLDI1LjR2NGgxLjVjMC4zLDAsMC40LDAsMC42LTAuMXMwLjQtMC4xLDAuNS0wLjRjMC4xLTAuMSwwLjMtMC40LDAuNC0wLjZzMC4xLTAuNiwwLjEtMWMwLTAuMSwwLTAuNC0wLjEtMC42YzAtMC4zLTAuMS0wLjQtMC4zLTAuNmMtMC4xLTAuMy0wLjQtMC40LTAuNi0wLjVjLTAuMy0wLjEtMC42LTAuMy0xLTAuM2gtMS4xVjI1LjR6Ii8+PHBhdGggY2xhc3M9InN0MiIgZD0iTTMyLjIsMjguOWMwLDAuOS0wLjEsMS41LTAuMywyLjFjLTAuMSwwLjYtMC40LDEuMS0wLjYsMS41Yy0wLjMsMC40LTAuNiwwLjctMC45LDFjLTAuNCwwLjMtMC42LDAuNC0xLDAuNWMtMC40LDAuMS0wLjYsMC4xLTAuOSwwLjNjLTAuMywwLTAuNSwwLTAuNiwwaC0zLjlWMjQuMWgzYzAuOSwwLDEuNiwwLjEsMi4yLDAuNGMwLjYsMC4zLDEuMSwwLjYsMS42LDEuMWMwLjQsMC41LDAuNywxLDEsMS41QzMyLjEsMjcuOCwzMi4yLDI4LjQsMzIuMiwyOC45TDMyLjIsMjguOXogTTI3LjMsMzNjMS4xLDAsMS45LTAuNCwyLjQtMS4xYzAuNS0wLjcsMC43LTEuOCwwLjctMy4xYzAtMC40LDAtMC45LTAuMS0xLjJzLTAuMy0wLjctMC42LTEuMWMtMC4zLTAuNC0wLjYtMC42LTEuMS0wLjdjLTAuNS0wLjMtMS4xLTAuMy0xLjktMC4zaC0xVjMzTDI3LjMsMzNMMjcuMywzM3oiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMzYuMiwyNS40djMuMWg0LjN2MS4xaC00LjN2NC41aC0xLjZWMjRoNi4zdjEuM2gtNC42VjI1LjR6Ii8+PC9nPjwvc3ZnPg==');
  		}
  		else if($txt == 'application/doc'){
  			$im = sprintf('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1NiA1NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTYgNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPi5zdDB7ZmlsbDojMDA5NkU2O30uc3Qxe2ZpbGw6IzAwNjJCMjt9LnN0MntmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTM3LDBIOEM3LjIsMCw2LjUsMC43LDYuNSwxLjlWNTVjMCwwLjMsMC43LDEsMS41LDFINDhjMC44LDAsMS41LTAuNywxLjUtMVYxM2MwLTAuNy0wLjEtMC45LTAuMy0xLjFMMzcuNiwwLjNDMzcuNCwwLjEsMzcuMiwwLDM3LDB6Ii8+PHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSIzNy41LDAuMiAzNy41LDEyIDQ5LjMsMTIgIi8+PGc+PHBhdGggY2xhc3M9InN0MiIgZD0iTTIyLjUsMjkuOGMwLDAuOC0wLjEsMS41LTAuMywyLjFzLTAuNCwxLjEtMC43LDEuNXMtMC42LDAuNy0wLjksMC45cy0wLjcsMC40LTEsMC41QzE5LjMsMzQuOSwxOSwzNSwxOC44LDM1Yy0wLjMsMC0wLjUsMC0wLjYsMGgtMy44VjI1aDNjMC44LDAsMS42LDAuMSwyLjIsMC40czEuMiwwLjYsMS42LDEuMXMwLjcsMSwxLDEuNUMyMi40LDI4LjYsMjIuNSwyOS4yLDIyLjUsMjkuOHogTTE3LjYsMzMuOWMxLjEsMCwxLjktMC40LDIuNC0xLjFzMC43LTEuNywwLjctMy4xYzAtMC40LDAtMC44LTAuMS0xLjJjLTAuMS0wLjQtMC4zLTAuOC0wLjYtMS4xcy0wLjctMC42LTEuMi0wLjhzLTEuMS0wLjMtMS45LTAuM2gtMXY3LjZDMTYsMzMuOSwxNy42LDMzLjksMTcuNiwzMy45eiIvPjxwYXRoIGNsYXNzPSJzdDIiIGQ9Ik0zMi41LDMwYzAsMC44LTAuMSwxLjYtMC4zLDIuMnMtMC41LDEuMi0wLjksMS42Yy0wLjQsMC40LTAuOCwwLjgtMS4zLDFzLTEuMSwwLjMtMS43LDAuM3MtMS4yLTAuMS0xLjctMC4zcy0wLjktMC41LTEuMy0xcy0wLjctMS0wLjktMS42cy0wLjMtMS40LTAuMy0yLjJzMC4xLTEuNiwwLjMtMi4yYzAuMi0wLjYsMC41LTEuMiwwLjktMS42YzAuNC0wLjQsMC44LTAuOCwxLjMtMXMxLjEtMC4zLDEuNy0wLjNzMS4yLDAuMSwxLjcsMC4zczAuOSwwLjUsMS4zLDFjMC40LDAuNCwwLjcsMSwwLjksMS42QzMyLjQsMjguNCwzMi41LDI5LjIsMzIuNSwzMHogTTI4LjIsMzMuOGMwLjMsMCwwLjctMC4xLDEtMC4yYzAuMy0wLjEsMC42LTAuMywwLjgtMC42YzAuMi0wLjMsMC40LTAuNywwLjYtMS4yczAuMi0xLjEsMC4yLTEuOGMwLTAuNy0wLjEtMS4zLTAuMi0xLjdjLTAuMS0wLjUtMC4zLTAuOS0wLjUtMS4ycy0wLjUtMC41LTAuOC0wLjdjLTAuMy0wLjEtMC42LTAuMi0wLjktMC4yYy0wLjMsMC0wLjcsMC4xLTEsMC4yYy0wLjMsMC4xLTAuNiwwLjMtMC44LDAuNmMtMC4yLDAuMy0wLjQsMC43LTAuNiwxLjJzLTAuMiwxLjEtMC4yLDEuOGMwLDAuNywwLjEsMS4zLDAuMiwxLjhzMC4zLDAuOSwwLjUsMS4yczAuNSwwLjUsMC44LDAuN0MyNy42LDMzLjcsMjcuOSwzMy44LDI4LjIsMzMuOHoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNNDEuNiwzNC4xYy0wLjQsMC40LTAuOCwwLjYtMS4zLDAuOGMtMC41LDAuMi0xLDAuMy0xLjUsMC4zYy0wLjYsMC0xLjItMC4xLTEuNy0wLjNzLTAuOS0wLjUtMS4zLTFzLTAuNy0xLTAuOS0xLjZzLTAuMy0xLjQtMC4zLTIuMnMwLjEtMS42LDAuMy0yLjJjMC4yLTAuNiwwLjUtMS4yLDAuOS0xLjZjMC40LTAuNCwwLjgtMC44LDEuMy0xYzAuNS0wLjIsMS4xLTAuMywxLjctMC4zYzAuNSwwLDEuMSwwLjEsMS41LDAuM2MwLjUsMC4yLDAuOSwwLjUsMS4zLDAuOGwtMS4xLDFjLTAuMi0wLjMtMC41LTAuNS0wLjgtMC42cy0wLjYtMC4yLTAuOS0wLjJjLTAuMywwLTAuNywwLjEtMSwwLjJjLTAuMywwLjEtMC42LDAuMy0wLjgsMC42Yy0wLjIsMC4zLTAuNCwwLjctMC42LDEuMnMtMC4yLDEuMS0wLjIsMS44YzAsMC43LDAuMSwxLjMsMC4yLDEuOHMwLjMsMC45LDAuNSwxLjJzMC41LDAuNSwwLjgsMC43YzAuMywwLjEsMC42LDAuMiwwLjksMC4yczAuNi0wLjEsMC45LTAuMnMwLjUtMC4zLDAuOC0wLjZMNDEuNiwzNC4xeiIvPjwvZz48L3N2Zz4=');
  		}
  		else if($txt == 'application/zip'){
  			$im = sprintf('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1NiA1NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTYgNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPi5zdDB7ZmlsbDojNTU2MDgwO30uc3Qxe2ZpbGw6IzNGNDg1RTt9LnN0MntmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTM3LDBIOEM3LjIsMCw2LjUsMC43LDYuNSwxLjlWNTVjMCwwLjMsMC43LDEsMS41LDFINDhjMC44LDAsMS41LTAuNywxLjUtMVYxM2MwLTAuNy0wLjEtMC45LTAuMy0xLjFMMzcuNiwwLjNDMzcuNCwwLjEsMzcuMiwwLDM3LDB6Ii8+PHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSIzNy41LDAuMiAzNy41LDEyIDQ5LjMsMTIgIi8+PGc+PHBhdGggY2xhc3M9InN0MiIgZD0iTTI0LjksMjV2MS4zbC00LjgsNy4ybC0wLjMsMC4yaDUuMVYzNWgtNi43di0xLjNsNC44LTcuMmwwLjMtMC4yaC01LjFWMjVIMjQuOXoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMjguOSwzNWgtMS43VjI1aDEuN1YzNXoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMzMsMzVoLTEuNlYyNWgyLjljMC40LDAsMC45LDAuMSwxLjMsMC4yczAuOCwwLjMsMS4xLDAuNmMwLjMsMC4zLDAuNiwwLjYsMC44LDFzMC4zLDAuOCwwLjMsMS4zYzAsMC41LTAuMSwxLTAuMywxLjRjLTAuMiwwLjQtMC40LDAuOC0wLjcsMWMtMC4zLDAuMy0wLjcsMC41LTEuMSwwLjdzLTAuOSwwLjItMS40LDAuMkgzM0wzMywzNUwzMywzNXogTTMzLDI2LjJ2NGgxLjVjMC4yLDAsMC40LDAsMC42LTAuMWMwLjItMC4xLDAuNC0wLjIsMC41LTAuM3MwLjMtMC40LDAuNC0wLjZzMC4yLTAuNiwwLjItMWMwLTAuMiwwLTAuNC0wLjEtMC42YzAtMC4yLTAuMS0wLjQtMC4zLTAuNmMtMC4xLTAuMi0wLjMtMC40LTAuNi0wLjVzLTAuNi0wLjItMS0wLjJMMzMsMjYuMkwzMywyNi4yeiIvPjwvZz48L3N2Zz4=');
  		}
  		else{
  			imagestring($img, 5, ($this->get['w']/(count($exploreTxt)*4)), ($this->get['h']/(count($exploreTxt)*4)), $txt, $textcolor);
  			ob_start();
  			imagepng($img);
  			//header('Content-Type: image/png');
  			$im = sprintf('data:image/png;base64,%s', base64_encode(ob_get_clean()));
  		}
  		// printf('<img src="data:image/png;base64,%s"/ width="100">', base64_encode(ob_get_clean()));

  		//imagedestroy($img);
  		echo "<img src=\"{$im}\" height=\"100%\" width=\"100%\" style=\"margin:0;padding:0;position: fixed;top: 0;left: 0;\">";
  		#echo $im;
  		return $im;
    }

    public function upload_file(){
		$response = array (
			'status'    => 'error',
			'info'      => 'Error no detectado.'
		);
		$day = date("d");
		$mouth = date("m");
		$year = date("Y");
		$delete_file = 0;
		if(isset($this->post['delete_file'])){ $delete_file = $this->post['delete_file']; }
		$targetPath = folder_home . "/uploads/{$year}/{$mouth}/{$day}/";
		if ( !empty($this->files) && $delete_file == 0 ) {
			if (!file_exists($targetPath) && !is_dir($targetPath)) { mkdir($targetPath, 0777, true); }
			// Compruebe si la carpeta de carga si existe
			if ( file_exists($targetPath) && is_dir($targetPath) ) {
				// Comprueba si podemos escribir en el directorio de destino
				if ( is_writable($targetPath) ) {
					/** Empieza a bailar */
					$tempFile = $this->files['file']['tmp_name'];
					$targetFileName = $this->files['file']['name'];
					$targetFile = $targetPath . $targetFileName;

					// Compruebe si hay algún archivo con el mismo nombre
					if (file_exists($targetFile)) {
						$path = $this->files['file']['name'];
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$targetFileName = generateRandomString(16).".{$ext}";
						// Un archivo con el mismo nombre ya está aquí, cambiamos el nombre del archivo.
						$targetFile = $targetPath . $targetFileName;
					}
					move_uploaded_file($tempFile, $targetFile);
					// Asegúrese de que el archivo se haya subido
					if (file_exists($targetFile)) {
						$path_short = "/uploads/{$year}/{$mouth}/{$day}/" . $targetFileName;
						$file = new Media($this->adapter);
						$dataFile = array(
							"name" => $targetFileName,
							"type" => $this->files['file']['type'],
							"size" => $this->files['file']['size'],
							"path_full" => $targetFile,
							"path_short" => $path_short
						);
						$idFile = $file->crear($dataFile);
						if($idFile > 0){
							$dataFile['id'] = $idFile;

							if(isset($this->post['request_id'])){
								$requests_media = new RequestsMedia($this->adapter);
                $media = $requests_media->crear([
                  'request' => $this->post['request_id'],
                  'media' => $idFile
                ]);

                  $response = array (
                    'status'    => 'success',
                    'response'    => $dataFile,
                    'file_link' => $path_short,
                    'request' => $this->post['request_id'],
                    'media' => $requests_media,
                    'media_response' => $media
                  );
							}else{
                $response = array (
                  'status'    => 'success',
                  'response'    => $dataFile,
                  'file_link' => $path_short
                );
              }
						}else{
							$response = array (
								'status' => 'error',
								'info'   => 'No se pudo cargar el archivo solicitado :(, ocurrió un misterioso error.'
							);
						}
					} else {
						$response = array (
							'status' => 'error',
							'info'   => 'No se pudo cargar el archivo solicitado :(, ocurrió un misterioso error.'
						);
					}
				} else {
					$response = array (
						'status' => 'error',
						'info'   => 'La carpeta especificada para cargar no se puede escribir.'
					);
				}
			} else {
				$response = array (
					'status' => 'error',
					'info'   => 'No se pudo detectar la carpeta.'
				);
			}
		}
		else if($delete_file == 1){
			if(isset($this->post['target_file']) && $this->post['target_file'] > 0){
				$fileId = $this->post['target_file'];
				$file = new Media($this->adapter);
				$file->getById($fileId);

				if(isset($file->id) && $file->id > 0 && isset($file->path_full)){
					// Verificar si el archivo existe
					if ( file_exists($file->path_full) ) {
						// Eliminar el archivo
						unlink($file->path_full);
						// Asegúrate de haber eliminado el archivo
						if ( !file_exists($file->path_full) ) {
							if($file->eliminar() == true){
								$response = array (
									'status' => 'success',
									'info'   => 'Eliminado exitosamente.'
								);
							};
						} else {
							// Verifique los permisos del directorio
							$response = array (
								'status' => 'error',
								'info'   => 'Nos equivocamos, el archivo no se puede eliminar.'
							);
						}
					} else {
						// El archivo no existe.
						$response = array (
							'status' => 'error',
							'info'   => 'No se pudo encontrar el archivo solicitado :('
						);
					}
				}else{
					$response = array (
						'status' => 'error',
						'info'   => 'No se pudo encontrar el archivo solicitado :(',
						'file'   => $file
					);
				}

				/**/
			}
			else{
				$response = array (
					'status'    => 'error',
					'info'      => 'No existe archivo(s) para procesar.',
					'data'      => $this->post
				);
			}
		}
		else{
			$response = array (
				'status'    => 'error',
				'info'      => 'No existe archivo(s) para procesar.'
			);
		}

		// Devuelve la respuesta
		echo json_encode($response);
		return json_encode($response);
		exit;
    }
}
