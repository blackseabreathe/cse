<?php
	
	// Библиотера CseApi
	include_once 'CseApi.php';
	
	try{ 
		// Подключаемся
		$api = new CseApi(Array(
			'login' => 'МБИ-Ярославль',
			'password' => 'mbeyar'
		));
		
		// Пришли данные с формы
		if(isset($_POST['form'])){
			if($_POST['form'] == 'tracking') $result = $api->Tracking(Array(
				'number' => $_POST['tracking'], 
				'type' => $_POST['type']
			));
		}
	} catch (\Exception $e) {
		var_dump($e);
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Необходимые Мета-теги всегда на первом месте -->  
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		
		<!-- Bootstrap CSS -->  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
	</head>
	<body>
		
		<div class="container m-t-1">
			<?php if(isset($result) && !is_array($result)){ ?>
				<div class="alert alert-danger m-b-1" role="alert">
					<h4 class="alert-heading">Ошибка:</h4>
					<p><?= $result ?></p>
				</div>
			<?php } ?>
			<?php if(isset($result) && is_array($result)){ ?>
				<div class="alert alert-success m-b-1" role="alert">
					<h4 class="alert-heading">Результат:</h4>
					<p>
						<?php
							foreach($result as $key => $val){
								echo 'Дата: '.$val['DateTime'].'<br>';
								echo 'Состояние: '.$key.'<br>';
								if(!empty($val['Comment'])) echo 'Примечание: '.$val['Comment'].'<br>';
								echo '<hr>';
							}
						?>
					</p>
				</div>
			<?php } ?>
			<div class="row">
				<div class="col-xs-10 pull-xs-right m-b-1">
					<h1>Отслеживание</h1>
				</div>
			</div>
			<form method="post">
				<div class="form-group row">
					<label class="col-xs-2 col-form-label">Введите номер:</label>
					<div class="col-xs-10">
						<input name="tracking" class="form-control" type="text" value="<?= (isset($_POST['tracking']) ? $_POST['tracking'] : '') ?>">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-xs-2 col-form-label">Тип:</label>
					<div class="col-xs-10">
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="type" value="Order" checked> Заказ
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="type" value="Waybill"> Накладная
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-10 pull-xs-right m-b-1">
						<button type="submit" class="btn btn-secondary">Посмотреть</button>
					</div>
				</div>
				<input type="hidden" name="form" value="tracking">
			</form>
		</div>
		
		<!-- jQuery первый, затем Tether, затем Bootstrap JS. -->  
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
	</body>
</html>
