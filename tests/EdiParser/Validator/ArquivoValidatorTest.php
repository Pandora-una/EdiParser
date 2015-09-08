<?php
namespace EdiParser\Tests\Validator;

use EdiParser\Validator\ArquivoValidator;

class ArquivoValidatorTest extends \PHPUnit_Framework_TestCase 
{
    public function testArquivoValidatorValido()
    {
    	$resultado = ArquivoValidator::validate('tests/fixtures/PagamentoComCV/valido.cmp');
    	$this->assertEquals(true, $resultado);
   	}
       
}