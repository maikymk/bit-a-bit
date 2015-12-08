<?php

/**
 * Classe para testes bit-a-bit
 *
 * Realiza as acoes bit-a-bit que o usuario solicitar,
 * se for inteiro printa na tela o resultado da acao,
 * caso seja String, traz detalhes adicionais e mostra o valor
 * na tabela ASCII do operador definido pelo usuario para ajudar
 * a melhor compreender a diferenca entre operacoes bit-a-bit entre int e String.
 *
 * @author Maiky Alves da Silva <maikymk@hotmail.com>
 */

class Bitwise {

    /**
     * Exibe um texto sobre o uso de operadores String e coloca 
     * um separador para o resto do conteudo
     */
    public function __construct() {
        $this->msgString();
        $this->printTelaNx('|', 550);
    }

    /**
     * Faz a operacao passada pelo usuario
     * 
     * @param $a int|String Primeiro operador
     * @param $op String Operacao a ser realizada
     * @param $b int|String Segundo operador
     */
    public function binario($a, $op, $b = null) {
        if (isset($a) && isset($b)) {
            if ($op = $this->validaOp($op)) {
                if (is_string($a) && is_string($b)) {
                    $c = eval("return ('" . $a . "' $op '" . $b . "');");
                    
                    $this->printString($a);
                    $this->printString($b);
                    $this->printString($c);
                } else {
                    $c = eval("return ($a $op $b);");
                    
                    $this->printVal($a);
                    $this->printVal($b);
                    $this->printVal($c);
                }
                
                echo '<br>'.$this->printTelaNx('-', 300);
                echo 'Result: (' . $a . ' ' . $op . ' ' . $b . ') = ' . $c.'<br>';
            } else {
                echo utf8_encode('ERRO!! Verifique a operação que está tentando executar e tente novamente.');
            }
        } elseif (isset($a)) {
            $c = ~ (int) $a;
            $this->printVal($a);
            $this->printVal($c);
            
            echo '<br>'.$this->printTelaNx('-', 300);
            echo 'Result: ~' . $a . ' = ' . $c.'<br>';
        }
        
        $this->printTelaNx('|', 550);
    }

    /**
     * Valida o tipo de operacao bitwise
     * #param String $op Operacao bit-a-bit solicitada pelo usuario
     */
    private function validaOp($op = '&') {
        $return = false;
        switch ($op) {
            case '&':
                $return = '&';
                break;
            case '|':
                $return = '|';
                break;
            case '^':
                $return = '^';
                break;
            case '>>':
                $return = '>>';
                break;
            case '<<':
                $return = '<<';
                break;
        }
        
        return $return;
    }

    /**
     * Exibe na tela informacoes sobre a int passado
     * 
     * @param int $val Inteiro a buscar as informacoes
     */
    private function printVal($val) {
        echo $this->printTelaNx('-', 300);
        var_dump($val);
        echo 'Binario ' . $val . ' = ' . decbin($val) . '<br>';
    }

    /**
     * Exibe na tela informacoes sobre a String passado
     * 
     * @param String $val String a buscar as informacoes
     */
    private function printString($val) {
        $this->printVal($val);
        echo 'ASCII ' . $val . ' = ' . ord($val) . '<br>';
        echo 'Binario ASCII ' . $val . ' = ' . decbin(ord($val));
        echo '<br>';
    }

    /**
     * Mostra uma mensagem sobre o que acontece
     * quando os operadores String
     */
    private function msgString() {
        echo '<h1>Strings</h1>';
        echo utf8_encode('
            Se ambos os operandos de &, | e ^ forem strings então a operação será realizada nos valores ASCII dos caracteres das strings, <br>
            e o resultado final será uma string. Em todos os outros casos ambos os operandos serão convertidos para inteiros e o <br>
            resultado será um inteiro.<br><br>
            Se o operando de ~ for uma string então a operação será realizada nos valores ASCII dos caracteres da string, <br>
            e o resultado será uma string. Nos demais casos o operando e o resultado serão tratados como inteiros.<br><br>
            Ambos os operandos e o resultado para << e >> sempre são tratados como inteiros.<br><br>
            Saiba mais clicando <a target="_new" href="http://php.net/manual/pt_BR/language.operators.bitwise.php">aqui</a><br>
        ');
    }

    /**
     * Printa um caractere na tela 200x ou a quantidade que o user passar
     * 
     * @param String $car Caractere a ser exibido na tela
     */
    public function printTelaNx($car = '-', $x = 200) {
        echo '<br>';
        for($i = 0; $i < $x; $i++ ) {
            echo $car;
        }
        echo '<br>';
    }
}

$obj = new Bitwise();
$obj->binario(25, '|', 5);
$obj->binario(0, '~');