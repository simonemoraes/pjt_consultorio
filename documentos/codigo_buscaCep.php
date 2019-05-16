<!-- Codigo para busca por cep -->
<?php
//code here
$resultado = @file_get_contents('https://viacep.com.br/ws/'.$param['enderecos_paciente_cep'].'/json/');

$result = json_decode($resultado);

 if($result !== null)
 {

	 $data = new StdClass;

	 $data->enderecos_paciente_logradouro = $result->{'logradouro'};
	 $data->enderecos_paciente_bairro = $result->{'bairro'};
	 $data->enderecos_paciente_cidade = $result->{'localidade'};
	 $data->enderecos_paciente_estado = $result->{'uf'}; 
	 TForm::sendData(self::$formName, $data);
 }
 else
 {
	new TMessage('error', "O Cep digitado é inválido!!");
	return true;  

 }
 ?>
