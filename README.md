# PHPProceda
Ferramenta para parse de informações de EDI Proceda | OCOREN em php

## Baixe:

Composer:

    composer require luanfreitasdev/edi_ocoren

## Use:

``` 
$edi      = new \PHPProceda\EDI\Interpreter();
$edi->setLayout(3); // Versão do EDI
$edi->setFile($file); // Local onde o arquivo se encontra
$result         = $edi->json();

print_r($result);
```

#### * Exemplo de retorno:
```
{
	"cabInter": {
		"identRem": "BRASPRESS",
		"identDest": "SND DISTRIBUI\u00c7\u00c3O DE PRODUTOS DE I",
		"identData": "",
		"identHora": "20:00",
		"identInter": "26OCO0203082"
	},
	"cabDoc": {
		"identDoc": "OCORR020308261"
	},
	"identTransp": {
		"tpCNPJ": "48740351001641",
		"tpRSocial": "BRASPRESS TRANSPORTES URGENTES LTDA"
	},
	"ocoEntrega": [{
		"nfeCNPJ": "02101894001880",
		"nfeSerie": "23",
		"nfeNum": "00040935",
		"codOcor": "01",
		"OcoData": "2020-02-28",
		"OcoHora": "12:00",
		"codObs": "00",
		"txtLivre": "",
		"descObs": "00",
		"descOcor": "Entrega realizada Normalmente "
	}]
}
```

## Versão EDI suportada

#### 3.1

