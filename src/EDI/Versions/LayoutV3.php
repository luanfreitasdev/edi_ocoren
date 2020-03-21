<?php

namespace PHPProceda\EDI\Versions;

class LayoutV3
{
    /**
     * @param $cod
     * @return mixed
     */
    public static function makeDescObservacoes ( $cod) {
        $array = array (
            '01'=>'Devolução/Recusa Total',
            '02'=>'Devolução/Recusa Parcial',
            '03'=>'Aceite/entrega de acordo'
        );
        return $array[$cod];
    }

    /**
     * @param $cod
     * @return mixed
     */
    public static function makeDescOcorrencia ( $cod) {
        $array = array (
            '00'=>'Processo de Transporte já Iniciado',
            '01'=>'Entrega realizada Normalmente',
            '02'=>'Entrega Fora da Data Programadas',
            '03'=>'Recusa por falta de Pedido de Compra',
            '04'=>'Recusa por Pedido de Compra Cancelado',
            '05'=>'Falta de Espaço Físico no Depósito do Cliente Destino',
            '06'=>'Endereço do Cliente Destino não localizado',
            '07'=>'Devolução não Autorizada pelo Cliente',
            '08'=>'Preço Mercadoria em Desacordo com o Pedido Compra',
            '09'=>'Mercadoria em Desacordo com o Pedido Compra',
            '10'=>'Cliente Destino somente Recebe Mercadoria com Frete Pago',
            '11'=>'Recusa por Deficiência Embalagem Mercadoria',
            '12'=>'Redespacho não Indicado',
            '13'=>'Transportadora não Atende a Cidade do Cliente Destino',
            '14'=>'Mercadoria Sinistrada',
            '15'=>'Embalagem Sinistrada',
            '16'=>'Pedido de Compras em Duplicidade',
            '17'=>'Mercadoria fora da Embalagem de Atacadista',
            '18'=>'Mercadorias Trocadas',
            '19'=>'Reentrega Solicitada pelo Cliente',
            '20'=>'Entrega Prejudicada por Horário/Falta de Tempo Hábil',
            '21'=>'Estabelecimento Fechado',
            '22'=>'Reentrega sem Cobrança do Cliente',
            '23'=>'Extravio de Mercadoria em Trânsito',
            '24'=>'Mercadoria Reentregue ao Cliente Destino',
            '25'=>'Mercadoria Devolvida ao Cliente de Origem',
            '26'=>'Nota Fiscal Retida pela Fiscalização',
            '27'=>'Roubo de Carga',
            '28'=>'Mercadoria Retida até Segunda Ordem',
            '29'=>'Cliente Retira Mercadoria na Transportadora',
            '30'=>'Problema com a Documentação (Nota Fiscal e/ou CTRC)',
            '31'=>'Entrega com Indenização Efetuada',
            '32'=>'Falta com Solicitação de Reposição',
            '33'=>'Falta com Busca/Reconferência',
            '34'=>'Cliente Fechado para Balanço',
            '35'=>'Quantidade de Produto em Desacordo (Nota Fiscal e/ou Pedido)',
            '36'=>'Extravio de documentos pela cia. Aérea',
            '37'=>'Extravio de carga pela cia. Aérea',
            '38'=>'Avaria de carga pela cia. Aérea',
            '39'=>'Corte de carga na pista',
            '40'=>'Aeroporto fechado na origem',
            '41'=>'Pedido de Compra Incompleto',
            '42'=>'Nota Fiscal com Produtos de Setores Diferentes',
            '43'=>'Feriado Local/Nacional',
            '44'=>'Excesso de Veículos',
            '45'=>'Cliente Destino Encerrou Atividades',
            '46'=>'Responsável de Recebimento Ausente',
            '47'=>'Cliente Destino em Greve',
            '48'=>'Aeroporto fechado no destino',
            '49'=>'Vôo cancelado',
            '50'=>'Greve nacional (Greve Geral)',
            '51'=>'Mercadoria Vencida (Data de Validade Expirada)',
            '52'=>'Mercadoria Redespachada (Entregue para Redespacho)',
            '53'=>'Mercadoria não foi Embarcada, Permanecendo na Origem',
            '54'=>'Mercadoria Embarcada sem Conhecimento/Conhecimento não Embarcado',
            '55'=>'Endereço de Transportadora de Redespacho não Localizado/Informado',
            '56'=>'Cliente não Aceita Mercadoria com Pagamento de Reembolso',
            '57'=>'Transportadora não Atende a Cidade da Transportadora de Redespacho',
            '58'=>'Quebra do Veiculo de Entrega',
            '59'=>'Cliente sem Verba para Pagar o Frete',
            '60'=>'Endereço de Entrega Errado',
            '61'=>'Cliente sem Verba para Reembolso',
            '62'=>'Recusa da Carga por Valor de Frete Errado',
            '63'=>'Identificação do Cliente não Informada/Enviada/Insuficiente',
            '64'=>'Cliente não Identificado/Cadastrado',
            '65'=>'Entrar em Contato com o Comprador',
            '66'=>'Troca não Disponível',
            '67'=>'Fins Estatísticos',
            '68'=>'Data de Entrega Diferente do Pedido',
            '69'=>'Substituição Tributária',
            '70'=>'Sistema Fora do Ar',
            '71'=>'Cliente Destino não Recebe Pedido Parcial',
            '72'=>'Cliente Destino só Recebe Pedido Parcial',
            '73'=>'Redespacho somente com Frete Pago',
            '74'=>'Funcionário não autorizado a Receber Mercadorias',
            '75'=>'Mercadoria Embarcada para Rota Indevida',
            '76'=>'Estrada/Entrada de Acesso Interditada',
            '77'=>'Cliente Destino Mudou de Endereço',
            '78'=>'Avaria Total',
            '79'=>'Avaria Parcial',
            '80'=>'Extravio Total',
            '81'=>'Extravio Parcial',
            '82'=>'Sobra de Mercadoria sem Nota Fiscal',
            '83'=>'Mercadoria em poder da SUFRAMA para Internação',
            '84'=>'Mercadoria Retirada para Conferência',
            '85'=>'Apreensão Fiscal da Mercadoria',
            '86'=>'Excesso de Carga/Peso',
            '87'=>'Férias Coletivas',
            '88'=>'Recusado, aguardando negociação',
            '89'=>'Aguardando refaturamento das mercadorias',
            '90'=>'Recusado pelo Redespachante',
            '91'=>'Entrega Programada',
            '92'=>'Problemas Fiscais',
            '93'=>'Aguardando carta de correção',
            '94'=>'Recusa por divergência nas condições de pagamento',
            '95'=>'Carga aguardando vôo conexão',
            '96'=>'Carga sem embalagem própria para transp. Aéreo',
            '97'=>'Carga com dimensão superior ao porão da aeronave',
            '98'=>'Chegada na cidade ou filial de destino',
            '99'=>'Outros tipos de ocorrências não especificados acima'
        );
        return $array[$cod];

    }

    public static function getSkeleton ()
    {
        return array
        (
            '000' => array(
                // Registro para a identificação do arquivo de OCOREN gerado pela transportadora OCORRE = 1 POR ARQUIVO GERADO
                'cabInter' => array(
                    'identRem' => [3, 35], // IDENTIFICADOR DE REMETENTE
                    'identDest' => [38, 35], // IDENTIFICAÇÃO DO DESTINATÁRIO
                    'identData' => [73, 6], // Data
                    'identHora' => [79, 4], // Hora
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
                    'tpCNPJ' => [3, 14], // CNPJ DA TRANSPORTADORA
                    'tpRSocial' => [17, 40] // RAZÃO SOCIAL DA TRANSPORTADORA
                ),
            ),
            // Ocorrência na Entrega
            '342' => array(
                'ocoEntrega' => array(
                    'nfeCNPJ' => [3, 14], //CNPJ DA EMBARCADORA
                    'nfeSerie' => [17, 3], //SÉRIE DA NOTA FISCAL
                    'nfeNum' => [20, 8], //NÚMERO DA NOTA FISCAL
                    'codOcor' => [28, 2], //CÓDIGO DE OCORRÊNCIA NA ENTREGA
                    'OcoData' => [30, 8], //DATA DA OCORRÊNCIA
                    'OcoHora' => [38, 4], //HORA DA OCORRÊNCIA
                    'codObs' => [42, 2], //CÓDIGO DE OBSERVAÇÃO DE OCORRÊNCIA NA ENTRADA
                    'txtLivre' => [44, 70]
                ),
            ),
        );
    }

}
