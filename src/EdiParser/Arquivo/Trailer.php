<?php
namespace EdiParser\Arquivo;

class Trailer extends LinhaAbstract{
	
	protected $posicoes = array(
			'totalDeRegistros'=>array('i'=>2,'t'=>11)
	);
	
	protected $totalDeRegistros;
	
	public function getTotalDeRegistros() {
		return $this->totalDeRegistros;
	}
	public function setTotalDeRegistros($totalDeRegistros) {
		$this->totalDeRegistros = (int)$totalDeRegistros;
		return $this;
	}
	
	
}