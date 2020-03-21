<?php

namespace PHPProceda\EDI;

use DateTime;
use PHPProceda\EDI\Versions\LayoutV3;

class Interpreter
{
    /**
     * @var array
     */
    private $config;
    /**
     * @var string
     */
    private $file;
    /**
     * @var integer
     */
    protected $version;
    /**
     * @var array
     */
    private $skeleton = [];

    /**
     * @param $version
     */
    public function setLayout ($version) {
        $this->version = $version;
        if ($version = 3) {
            $this->skeleton = LayoutV3::getSkeleton();
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
                    if (isset($l['cabInter']['identData'])) {
                        $l['cabInter']['identData']       = DateTime::createFromFormat('dmy', $l['cabInter']['identData'])->format('Y-m-d');
                    }
                    if (isset($l['cabInter']['identHora'])) {
                        $l['cabInter']['identHora']       = DateTime::createFromFormat('Hm', $l['cabInter']['identHora'])->format('H:i');
                    }
                    if (isset($l['ocoEntrega']['codObs'])) {
                        $l['ocoEntrega']['descObs'] = LayoutV3::makeDescObservacoes($l['ocoEntrega']['codObs']);
                    }
                    if (isset($l['ocoEntrega']['codOcor'])) {
                        $l['ocoEntrega']['descOcor'] = LayoutV3::makeDescOcorrencia($l['ocoEntrega']['codOcor']);
                    }
                    if (isset($l['ocoEntrega']['OcoData'])) {
                        $l['ocoEntrega']['OcoData']    = DateTime::createFromFormat('dmY', $l['ocoEntrega']['OcoData'])->format('Y-m-d');
                    }
                    if (isset($l['ocoEntrega']['OcoHora'])) {
                        $l['ocoEntrega']['OcoHora']    = DateTime::createFromFormat('Hm', $l['ocoEntrega']['OcoHora'])->format('H:i');
                    }
                    if ($code == '342') {
                        $transformer[$code][] = $l['ocoEntrega'];
                    } else {
                        $transformer[$code] = $l;
                    }
                }
            }
        }
        $new['cabInter']    = $transformer['000']['cabInter'];
        $new['cabDoc']      = $transformer['340']['cabDoc'];
        $new['identTransp'] = $transformer['341']['identTransp'];
        $new['ocoEntrega']  = $transformer['342'];

        return $new;
    }

    /**
     * @param $line
     * @return array
     */
    public function processLine ($line)
    {
        $code           = substr($line, 0, 3);

        if (isset($this->skeleton[$code])) {
            $notFisArgs = $this->skeleton[$code];
            return $this->extract($line, $notFisArgs);
        }
        return [];
    }

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
