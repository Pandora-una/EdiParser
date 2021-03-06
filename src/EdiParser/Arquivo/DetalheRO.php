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
	
	protected $msgAjuste = array(
			1 => 'Acerto de correção monetária',
			2 => 'Acerto de data de pagamento',
			3 => 'Acerto de taxa de comissão',
			4 => 'Acerto de valores não processados',
			5 => 'Acerto de valores não recebidos',
			6 => 'Acerto de valores não reconhecidos',
			7 => 'Acerto de valores negociados',
			8 => 'Acerto de valores processados indevidamente',
			9 => 'Acerto de lançamento não compensado em conta-corrente',
			10 => 'Acerto referente valores contestados',
			11 => 'Acerto temporário de valores contestados',
			12 => 'Acertos diversos',
			13 => 'Acordo de cobrança',
			14 => 'Acordo jurídico',
			15 => 'Aplicação de multa Programa Monitoria Chargeback',
			16 => 'Bloqueio de valor por ordem judicial',
			17 => 'Cancelamento da venda',
			18 => 'Cobrança de tarifa operacional',
			19 => 'Cobrança mensal Lynx Comércio',
			20 => 'Cobrança Plano Cielo',
			21 => 'Contrato de caução',
			22 => 'Crédito de devolução do cancelamento - banco emissor',
			23 => 'Crédito EC - referente contestação portador',
			24 => 'Crédito por cancelamento rejeitado - Cielo',
			25 => 'Processamento do débito duplicado - Visa Pedágio',
			26 => 'Débito por venda realizada sem a leitura do chip',
			27 => 'Débito por venda rejeitada no sistema - Cielo',
			28 => 'Débito referente à contestação do portador',
			29 => 'Estorno de acordo jurídico',
			30 => 'Estorno de contrato de caução',
			31 => 'Estorno de acordo de cobrança',
			32 => 'Estorno de bloqueio de valor por ordem judicial',
			33 => 'Estorno de cancelamento de venda',
			34 => 'Estorno de cobrança de tarifa operacional',
			35 => 'Estorno de cobrança mensal Lynx Comércio',
			36 => 'Estorno de cobrança Plano Cielo',
			37 => 'Estorno de débito venda sem a leitura do Chip',
			38 => 'Estorno de incentivo comercial',
			39 => 'Estorno de Multa Programa Monitoria Chargeback',
			40 => 'Estorno de rejeição ARV',
			41 => 'Estorno de reversão de duplicidade do pagamento - ARV',
			42 => 'Estorno de tarifa de cadastro',
			43 => 'Estorno de extrato no papel',
			44 => 'Estorno de processamento duplicado de débito - Visa Pedágio',
			45 => 'Incentivo comercial',
			46 => 'Incentivo por venda de Recarga',
			47 => 'Regularização de rejeição ARV',
			48 => 'Reversão de duplicidade do pagamento - ARV',
			49 => 'Tarifa de cadastro',
			50 => 'Tarifa de extrato no papel',
			51 => 'Aceleração de débito de antecipação',
			52 => 'Débito por descumprimento de cláusula contratual',
			53 => 'Débito por cancelamento de venda',
			54 => 'Débito por não reconhecimento de compra',
			55 => 'Débito por venda com cartão com validade vencida',
			56 => 'Débito por não reconhecimento de compra',
			57 => 'Débito por cancelamento e/ou devolução dos serviços',
			58 => 'Débito por transação irregular',
			59 => 'Débito por não entrega da mercadoria',
			60 => 'Débito por serviço não prestado',
			61 => 'Débito efetuado por venda sem código de autorização',
			62 => 'Débito efetuado por venda com número de cartão inválido',
			63 => 'Débito por cópia de CV e/ou documento não atendido',
			64 => 'Débito por venda efetuada com autorização negada',
			65 => 'Débito por envio de CV e/ou documento ilegível',
			66 => 'Débito por venda efetuada sem leitura de chip',
			67 => 'Débito por venda em outra moeda',
			68 => 'Débito por venda processada incorretamente',
			69 => 'Débito por cancelamento de venda',
			70 => 'Débito por crédito em duplicidade',
			71 => 'Débito por documentos solicitados e não recebidos',
			72 => 'Débito por envio de CV e/ou documento incorreto',
			73 => 'Débito por envio de CV e/ou documento fora do prazo',
			74 => 'Débito por não reconhecimento de despesa',
			75 => 'Débito por documentação solicitada incompleta',
			76 => 'Débito por estabelecimento não possui CV e/ou Doc.',
			77 => 'Programa de monitoria de chargeback',
			78 => 'Serviços Score',
			79 => 'Reagendamento do débito de antecipação',
			80 => 'Ajuste do débito de cessão'
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
	
	public function getMsgAjuste() {
		if (!$this->isAjuste())
			return '';
		return $this->msgAjuste[$this->getOrigemDoAjuste()];
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
