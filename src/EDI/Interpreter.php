<?php

namespace PHPProceda\EDI;

class Interpreter
{
    private $config;
    private $file;
    private $version;
    private $skeleton;

    /**
     * @param $version
     */
    public function setLayout ($version) {
        $this->version = $version;
        if ($version = 3) {
            $this->skeleton = $this->__skeleton_v3;
            $this->config   = ['000', '340', '341', '342'];
        } else {
            $this->config   = ['000', '540', '541', '542'];
        }
    }

    /**
     * @param $file
     */
    public function setFile ( $file) {
        $this->file = $file;
    }

    /**
     * @param array $transformer
     * @return array
     */
    public function convertOCORENToJSON ($transformer = []) {
        foreach(file($this->file) as $line) {
            $code = substr($line, 0, 3);
            if (in_array($code, $this->config)) {
                $l = $this->processLine($line);

                if ($this->version = 3) {
                    if ($code == '342') {
                        $transformer[$code][] = $l;
                    } else {
                        $transformer[$code] = $l;
                    }

                }
            }
        }
        return $transformer;
    }

    /**
     * @param $line
     * @param $version
     * @return array
     */
    public function processLine ($line)
    {
        $code           = substr($line, 0, 3);

        if (isset($this->skeleton[$code])) {
            $notfisArgs = $this->skeleton[$code];
            return $this->extract($line, $notfisArgs);
        }
    }

    private $__skeleton_v3 = array(
        '000' => array(
            // Registro para a identificação do arquivo de OCOREN gerado pela transportadora OCORRE = 1 POR ARQUIVO GERADO
            'cabInter' => array(
                'identRem' => [3, 35], // IDENTIFICADOR DE REMETENTE
                'identDest' => [38, 35], // IDENTIFICAÇÃO DO DESTINATÁRIO
                'data' => [73, 6], // Data
                'hora' => [79, 4], // Hora
                'identInter' => [83, 12],   // Identificação do Intercâmbio -
                                            // SUGESTÃO: "OCO50DDMM999"
                                            // "OCO50" = CONSTANTE OCOrrência+Versão 50
                                            // "DDMM"= DIA/MÊS
                                            // "SSS" = SEQUÊNCIA DE 0000 A 999
            ),
        ),
        // Registro para a especificação dos dados de identificação do documento OCOREN.
        '340' => array(
            'cabDoc' => array(
                'identDoc' => [3, 14] // identificação do documento
            ),
        ),
        // Registro para a especificação da identificação da empresa transportadora.
        '341' => array(
            'identTransp' => array(
                'CNPJ' => [3, 14], // CNPJ DA TRANSPORTADORA
                'rSocial' => [17, 40] // RAZÃO SOCIAL DA TRANSPORTADORA
            ),
        ),
        // Ocorrência na Entrega
        '342' => array(
            'ocoEntrega' => array(
                'nfeCnpjEm' => [3, 14], //CNPJ DA EMBARCADORA
                'nfeSerie' => [17, 3], //SÉRIE DA NOTA FISCAL
                'nfeNum' => [20, 8], //NÚMERO DA NOTA FISCAL
                'cOcor' => [28, 2], //CÓDIGO DE OCORRÊNCIA NA ENTREGA
                'dOcor' => [30, 8], //DATA DA OCORRÊNCIA
                'hOcor' => [40, 4], //HORA DA OCORRÊNCIA
                'cObsOco' => [42, 2], //CÓDIGO DE OBSERVAÇÃO DE OCORRÊNCIA NA ENTRADA
                'txtLivre' => [44, 70]
            ),
        ),
    );


    /**
     * Extrai em um array as diversas posições de uma linha
     * @param $line
     * @param $args
     * @return array
     */
    protected function extract( $line, $args )
    {
        $data = [];
        foreach ($args as $item => $composition) {
            foreach ($composition as $index => $pos) {
                $txt = trim(substr($line, $pos[0], $pos[1]));
                $data[$item][$index] = str_replace( chr( 194 ) . chr( 160 ), ' ', $txt );
            }
        }
        return $data;
    }


  /*
   *
                                              //  01 = Devolução/recusa total
                                              //  02 = Devolução/recusa parcial
                                              //  03 = Aceite/entrega por acordo
                                              //  04 = Devolução/recusa total com NF devolução
                                              //  emitida pelo destinatário
                                              //  05 = Devolução/recusa parcial c/ NF devolução
                                              //  emitida pelo destinatário
              'identCarg_01' => [], // NUMERO ROMANEIO, ORDEM DE COLETA, RESUMO DE CARGA, ETC. (Identificação do Embarque)
              'identCarg_02' => [], // OUTRO NÚMERO SAP, ACCOUNT, ETC. (Identificação do Embarque, Carga, etc.) – #2
              'identCarg_03' => [], // OUTRO NÚMERO SAP, ACCOUNT, ETC. (Identificação do Embarque, Carga, etc.) – #3
              'filEmissor'=> [], // FILIAL EMISSORA DO CONHECIMENTO
              'serCon' => [], // SÉRIE DO CONHECIMENTO
              'numCon' => [], // NÚMERO DO CONHECIMENTO
              'indEnt' => [], // INDICAÇÃO DO TIPO DE ENTREGA
              'codEmpNfe' => [], // CÓDIGO DA EMPRESA EMISSORA DA NOTA FISCAL
              'codFilEmpNfe' => [], // CÓDIGO DA FILIAL DA EMPRESSA EMISSORA DA NF
              'dChegadaDestNF' => [], // DATA DA CHEGADA NO DESTINO DA NF
              'hChegadaDestNF' => [], // HORA DA CHEGADA NO DESTINO DA NF
              'dIniDescDest' => [], // DATA DO INÍCIO DO DESCARREGAMENTO NO DESTINO
              'hIniDescDest' => [], // HORA DO INÍCIO DO DESCARREGAMENTO NO DESTINO
              'dTermDescDest' => [], // DATA DO TÉRMINO DO DESCARREGAMENTO NO DESTINO
              'hTermDescDest' => [], // HORA DO TÉRMINO DO DESCARREGAMENTO NO DESTINO
              'dSaidDestNF' => [], // DATA DA SAÍDA DO DESTINO DA NF
              'hSaidDestNf' => [], // HORA DA SAÍDA DO DESTINO DA NF,
              'CNPJ_NFDev' => [], // CNPJ (CGC) DO EMISSOR DA NOTA FISCAL DEVOLUÇÃO
              'sNFeDev' => [], // SÉRIE DA NOTA FISCAL DEVOLUÇÃO
              'nNFeDev' => [], // NÚMERO DA NOTA FISCAL DEVOLUÇÃO*/

}
