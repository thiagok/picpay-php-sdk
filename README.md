# PicPay E-Commerce API - PHP SDK

SDK PHP agnóstico para a API de E-Commerce do PicPay.

## Dependências

* PHP >= 5.6

## Exemplos

Os trechos de código abaixo ilustram como o pacote pode ser utilizado para fazer a comunicação como PicPay.

### Efetuando um pagamento

```php
<?php

require_once('vendor/autoload.php');

use Picpay\Payment;
use Picpay\Buyer;
use Picpay\Seller;
use Picpay\Request\PaymentRequest;
use Picpay\Exception\RequestException;

// Dados da loja (PicPay Token e Seller Token)
$seller = new Seller('5b008cef7f321d00ef2367b2', '4ef4edbd-5cda-42da-860b-0e8d7b90c784');

// Dados do comprador
$buyer = new Buyer('João', 'Da Silva', '123.456.789-10', 'teste@picpay.com', '+55 27 12345-6789');

// Dados do pedido
$payment = new Payment('102030', 'http://www.sualoja.com.br/callback', 20.51, $buyer, 'http://www.sualoja.com.br/cliente/pedido/102030');

// PAGAMENTO
try {
    // Cria uma nova requisição de pagamento com os dados da loja e do pagamento
    $paymentRequest = new PaymentRequest($seller, $payment);

    // O retorno tem a url de pagamento no PicPay, o qrcode, data de expiracao e seu id do pedido
    $paymentResponse = $paymentRequest->execute();
} catch (RequestException $e) {
    // Tratar os erros da requisição aqui
    $errorMessage = $e->getMessage();
    $statusCode = $e->getCode();
    $errors = $e->getErrors();
}

```

### Tratando o Post de Notificação

```php
<?php

require_once('vendor/autoload.php');

use Picpay\Request\NotificationRemoteRequest;

// A implementação do tratamento da requisição de notificação (um POST na url enviada em callbackUrl - http://www.sualoja.com.br/callback nesse exemplo) varia de acordo com a tecnologia utilizada na loja.

// Para que o callback seja considerado confirmado, deve-se responder com HTTP Status 200.

// Podemos usar a classe NotificationRemoteRequest desse pacote para obter o authorizationId a partir do body da requisição enviada pelo PicPay

$remoteNotification = new NotificationRemoteRequest('{"referenceId": "102030","authorizationId": "5b01780ba8914c001a007673"}');

$authorizationId = $remoteNotification->getAuthorizationId();

```

### Obtendo o status de um pagamento

```php
<?php

require_once('vendor/autoload.php');

use Picpay\Seller;
use Picpay\Exception\RequestException;
use Picpay\Request\StatusRequest;

// Dados da loja (PicPay Token e Seller Token)
$seller = new Seller('5b008cef7f321d00ef2367b2', '4ef4edbd-5cda-42da-860b-0e8d7b90c784');

// STATUS
try {
    // Cria uma nova requisição de status do pagamento com os dados da loja e id do pedido
    $statusRequest = new StatusRequest($seller, '102030');

    // Faze a requisição. O retorno contém o status do pagamento, seu id do pedido e numero de autorizaçao caso esteja pago
    $statusResponse = $statusRequest->execute();
} catch (RequestException $e) {
    // Tratar os erros da requisição aqui
    $errorMessage = $e->getMessage();
    $statusCode = $e->getCode();
    $errors = $e->getErrors();
}

```

### Cancelando um pagamento

```php
<?php

require_once('vendor/autoload.php');

use Picpay\Seller;
use Picpay\Exception\RequestException;
use Picpay\Request\StatusRequest;

// Dados da loja (PicPay Token e Seller Token)
$seller = new Seller('5b008cef7f321d00ef2367b2', '4ef4edbd-5cda-42da-860b-0e8d7b90c784');

// CANCELAMENTO
try {
    // Cria uma nova requisição de cancelamento do pagamento com os dados da loja, id do pedido e codigo de autorização
    $cancelRequest = new CancelRequest($seller, '102030', '555008cef7f321d00ef236333');

    // Faze a requisição. O retorno contém o id do cancelamento e seu id do pedido
    $cancelResponse = $cancelRequest->execute();
} catch (RequestException $e) {
    // Tratar os erros da requisição aqui
    $errorMessage = $e->getMessage();
    $statusCode = $e->getCode();
    $errors = $e->getErrors();
}

```

## Documentação

Para mais informações, consultar a documentação da API E-Commerce PicPay em: [Documentação API E-Commerce](https://ecommerce.picpay.com/doc/)
