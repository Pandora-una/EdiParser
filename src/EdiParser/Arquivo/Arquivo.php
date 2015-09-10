<?php
namespace EdiParser\Arquivo;

use EdiParser\Validator\ArquivoValidator;

class Arquivo {
	
	protected $conteudo;
	
	protected $header;
	
	protected $detalhesRO = array();
	
	protected $trailer;
	
	const TIPO_HEADER = 0;
	const TIPO_TRAILER = 9;
	const TIPO_DETALHE_RO = 1;
	const TIPO_DETALHE_CV = 2;
	
	public function __construct($filename) {
		if (!file_exists($filename))
			throw new \Exception("Arquivo '$filename' não encontrado");
		
		$this->conteudo = file_get_contents($filename);
		
		$linhas = file($filename);
		
		$lastDetalheRO = null;
		
		if (ArquivoValidator::validate($filename)) {
			foreach ($linhas as $linha) {
				switch ($linha[0]) {
					case self::TIPO_HEADER:
					$this->header = new Header($linha);
					break;
					
					case self::TIPO_TRAILER:
					$this->trailer = new Trailer($linha);
					break;
					
					case self::TIPO_DETALHE_RO:						
					$lastDetalheRO = new DetalheRO($linha);
					$this->detalhesRO[] = $lastDetalheRO;
					break;
					
					case self::TIPO_DETALHE_CV:
					$lastDetalheRO->addDetalheCV(new DetalheCV($linha));
					break;
							
					default:
					throw new \Exception("Arquivo com tipo não conhecido");
					break;
				}			
			}				
		}
		
	}
	public function getTipo() {
		return $this->header->getOpcaoDeExtrato();
	}
	public function getHeader() {
		return $this->header;
	}
	public function setHeader($header) {
		$this->header = $header;
		return $this;
	}
	public function getDetalhesRO() {
		return $this->detalhesRO;
	}
	public function setDetalhesRO($detalhesRO) {
		$this->detalhesRO = $detalhesRO;
		return $this;
	}
	public function getTrailer() {
		return $this->trailer;
	}
	public function setTrailer($trailer) {
		$this->trailer = $trailer;
		return $this;
	}
	public function getConteudo() {
		return $this->conteudo;
	}
	public function setConteudo($conteudo) {
		$this->conteudo = $conteudo;
		return $this;
	}
	
	
	
	
}