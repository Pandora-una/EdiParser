<?php
namespace EdiParser\Arquivo;

class DetalheRO extends LinhaAbstract{

	protected $posicoes = array(
			'tipoDeTransacao'=>array('i'=>24,'t'=>2),
			'dtPrevPagamento'=> array('i'=>32,'t'=>6,'type'=>'smalldate'),
			'valorBruto'=>array('i'=>44,'t'=>14,'type'=>'currency'),
			'valorComissao'=>array('i'=>58,'t'=>14,'type'=>'currency'),
			'valorRejeitado'=>array('i'=>72,'t'=>14,'type'=>'currency'),
			'valorLiquido'=> array('i'=>86,'t'=>14,'type'=>'currency'),
			'statusPagamento' => array('i'=>123,'t'=>2),
			'origemDoAjuste' => array('i'=>146,'t'=>2),
			'dtCaptura' =>array('i'=>140,'t'=>6,'type'=>'smalldate'),
			'taxaDeComissao' => array('i'=>210,'t'=>4,'type'=>'currency'),
			'tarifa' => array('i'=>214,'t'=>5,'type'=>'currency')
	);
	
	const TRANSACAO_VENDA = 1;
	const TRANSACAO_AJUSTE_CREDITO = 2;
	const TRANSACAO_AJUSTE_DEBITO = 3;
	const TRANSACAO_PACOTE_CIELO = 4;
	const TRANSACAO_REAGENDAMENTO = 5;
	
	const PAGAMENTO_AGENDADO = 0;
	const PAGAMENTO_PAGO = 1;
	const PAGAMENTO_ENVIADO_BANCO = 2;
	const PAGAMENTO_A_CONFIRMAR = 3;
	
	
	protected $detalhesCV = array();
	
	
	protected $tipoDeTransacao;
	protected $statusPagamento;
	protected $valorBruto;
	protected $valorComissao;
	protected $valorRejeitado;
	protected $valorLiquido;
	protected $dtPrevPagamento;
	protected $dtCaptura;
	
	protected $origemDoAjuste;
	
	protected $tarifa;
	protected $taxaDeComissao;
	
	public function addDetalheCV(DetalheCV $detalheCV) {
		$this->detalhesCV[] = $detalheCV;
	}
	
	public function getTipoDeTransacao() {
		return $this->tipoDeTransacao;
	}
	public function setTipoDeTransacao($tipoDeTransacao) {
		$tipoDeTransacao = (int)$tipoDeTransacao;
		if (!in_array($tipoDeTransacao, array(self::TRANSACAO_AJUSTE_CREDITO,self::TRANSACAO_AJUSTE_DEBITO,
											 self::TRANSACAO_PACOTE_CIELO,self::TRANSACAO_REAGENDAMENTO,
											 self::TRANSACAO_VENDA)))
			throw new \Exception("Tipo de transação '$tipoDeTransacao' inválido");
		
		$this->tipoDeTransacao = $tipoDeTransacao;
		return $this;
	}
	public function getStatusPagamento() {
		return $this->statusPagamento;
	}
	public function setStatusPagamento($statusPagamento) {
		$statusPagamento = (int)$statusPagamento;
		if (!in_array($statusPagamento, array(self::PAGAMENTO_A_CONFIRMAR,self::PAGAMENTO_AGENDADO,
				self::PAGAMENTO_ENVIADO_BANCO,self::PAGAMENTO_PAGO)))
					throw new \Exception("Status do Pagamento '$statusPagamento' inválido");
		
		$this->statusPagamento = $statusPagamento;
		return $this;
	}
	public function getValorBruto() {
		return $this->valorBruto;
	}
	public function setValorBruto($valorBruto) {
		$this->valorBruto = $valorBruto;
		return $this;
	}
	public function getValorComissao() {
		return $this->valorComissao;
	}
	public function setValorComissao($valorComissao) {
		$this->valorComissao = $valorComissao;
		return $this;
	}
	public function getValorRejeitado() {
		return $this->valorRejeitado;
	}
	public function setValorRejeitado($valorRejeitado) {
		$this->valorRejeitado = $valorRejeitado;
		return $this;
	}
	public function getValorLiquido() {
		return $this->valorLiquido;
	}
	public function setValorLiquido($valorLiquido) {
		$this->valorLiquido = $valorLiquido;
		return $this;
	}
	public function getDtPrevPagamento() {
		return $this->dtPrevPagamento;
	}
	public function setDtPrevPagamento(\DateTime $dtPrevPagamento) {
		$this->dtPrevPagamento = $dtPrevPagamento;
		return $this;
	}
	public function getDtCaptura() {
		return $this->dtCaptura;
	}
	public function setDtCaptura(\DateTime $dtCaptura) {
		$this->dtCaptura = $dtCaptura;
		return $this;
	}
	public function getDetalhesCV() {
		return $this->detalhesCV;
	}
	public function getOrigemDoAjuste() {
		return $this->origemDoAjuste;
	}
	public function setOrigemDoAjuste($origemDoAjuste) {
		$this->origemDoAjuste = $origemDoAjuste;
		return $this;
	}
	public function isAjuste() {
		return (trim($this->getOrigemDoAjuste()) != '');
	}
	public function getTarifa() {
		return $this->tarifa;
	}
	public function setTarifa($tarifa) {
		$this->tarifa = $tarifa;
		return $this;
	}
	public function getTaxaDeComissao() {
		return $this->taxaDeComissao;
	}
	public function setTaxaDeComissao($taxaDeComissao) {
		$this->taxaDeComissao = $taxaDeComissao;
		return $this;
	}
	
	
}