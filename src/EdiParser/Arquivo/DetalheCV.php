<?php
namespace EdiParser\Arquivo;

class DetalheCV extends LinhaAbstract{
	

	protected $posicoes = array(
			'dtVendaAjuste'=>array('i'=>38,'t'=>8,'type'=>'date'),
			'valor'=>array('i'=>46,'t'=>14,'type'=>'currency'),
			'tid'=>array('i'=>73,'t'=>20)
	);
	
	
	protected $dtVendaAjuste;
	protected $valor;
	protected $tid;
	
	
	
	
	public function getDtVendaAjuste() {
		return $this->dtVendaAjuste;
	}
	public function setDtVendaAjuste(\DateTime $dtVendaAjuste) {
		$this->dtVendaAjuste = $dtVendaAjuste;
		return $this;
	}
	public function getValor() {
		return $this->valor;
	}
	public function setValor($valor) {
		$this->valor = $valor;
		return $this;
	}
	public function getTid() {
		return $this->tid;
	}
	public function setTid($tid) {
		$this->tid = $tid;
		return $this;
	}
	
	
}