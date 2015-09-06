<?php
namespace EdiParser\Arquivo;

abstract class LinhaAbstract {
	protected $posicoes = array(
//		'estabelecimentoMatriz'=>array('i'=>2,'t'=>11),
	//	'dtProcessamento'=>array('i'=>12,'t'=>19,'type'=>'date')	
	);
	
	public function __construct($linha) {
		foreach ($this->posicoes as $campo => $pos) {
			$setter = 'set'. ucfirst($campo);
			$valor = substr($linha, $pos['i']-1,$pos['t']);
			if (isset($pos['type'])) {
				if ($pos['type'] == 'date')
					$valor = \DateTime::createFromFormat('Ymd', $valor);
				elseif ($pos['type'] == 'smalldate')
					$valor = \DateTime::createFromFormat('ymd', $valor);
				elseif ($pos['type'] == 'currency')
					$valor = (float)($valor/100);
				
			}
		
			$this->$setter($valor);
		}
	}
	
}