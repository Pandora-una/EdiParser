<?php
namespace EdiParser\Tests\Arquivo;

use EdiParser\Arquivo\Arquivo;

class ArquivoTest extends \PHPUnit_Framework_TestCase 
{
    public function testArquivoPagamentoComCVPodeSerLido()
    {
        $arquivo = new Arquivo('tests/fixtures/PagamentoComCV/valido.cmp');
        $this->assertNotNull($arquivo);
        $this->assertNotNull($arquivo->getConteudo());
        $this->assertNotNull($arquivo->getHeader());
        $this->assertNotNull($arquivo->getDetalhesRO());
        $this->assertNotNull($arquivo->getTrailer());

        $this->assertEquals(4, $arquivo->getTipo());
        $detalheRO = $arquivo->getDetalhesRO();
        $detalheRO = $detalheRO[0];
        /* @var $detalheRO \EdiParser\Arquivo\DetalheRO */
                
        $this->assertEquals(false, $detalheRO->isAjuste());
        $this->assertEquals('  ',$detalheRO->getOrigemDoAjuste());
 
        $this->assertEquals(75,$detalheRO->getValorBruto());
        $this->assertEquals(73.50,$detalheRO->getValorLiquido());

        $this->assertEquals(2,$detalheRO->getTaxaDeComissao());
        $this->assertEquals(3,$arquivo->getTrailer()->getTotalDeRegistros());
        
        $detalheCV = $detalheRO->getDetalhesCV();
        $detalheCV = $detalheCV[0];
        /* @var $detalheCV \EdiParser\Arquivo\DetalheCV */
        
        $this->assertEquals('10637169740000006D0A', $detalheCV->getTid());
        $this->assertEquals(50, $detalheCV->getValor());
    }
    
    public function testArquivoVendaComCVMaisParceladoFuturoPodeSerLido()
    {
    	$arquivo = new Arquivo('tests/fixtures/VendaComCVMaisParceladoFuturo/valido.cmp');
    	$this->assertNotNull($arquivo);
    	$this->assertNotNull($arquivo->getConteudo());
    	$this->assertNotNull($arquivo->getHeader());
    	$this->assertNotNull($arquivo->getDetalhesRO());
    	$this->assertNotNull($arquivo->getTrailer());
    
    	$this->assertEquals(3, $arquivo->getTipo());
    	$detalheRO = $arquivo->getDetalhesRO();
    	$detalheRO = $detalheRO[0];
    	/* @var $detalheRO \EdiParser\Arquivo\DetalheRO */

    	$this->assertEquals('  ',$detalheRO->getOrigemDoAjuste());
    	
    	
    	$this->assertEquals(150,$detalheRO->getValorBruto());
    	$this->assertEquals(144.44,$detalheRO->getValorLiquido());
    

    	$this->assertEquals(3.7,$detalheRO->getTaxaDeComissao());
    	
    	$this->assertEquals(34,$arquivo->getTrailer()->getTotalDeRegistros());
    
    	$detalheCV = $detalheRO->getDetalhesCV();
    	$detalheCV = $detalheCV[0];
    	/* @var $detalheCV \EdiParser\Arquivo\DetalheCV */
    
    	
    	$this->assertEquals('10637169740000006F4A', $detalheCV->getTid());
    	$this->assertEquals(50, $detalheCV->getValor());
    }
    
}