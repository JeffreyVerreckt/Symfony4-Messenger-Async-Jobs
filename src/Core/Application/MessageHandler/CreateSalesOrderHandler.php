<?php
namespace App\Core\Application\MessageHandler;

use App\Core\Domain\Message\CreateSalesOrder;

final class CreateSalesOrderHandler
{
    public function __invoke(CreateSalesOrder $createSalesOrder)
    {
        // Todo: Create Purchase order
        var_dump($createSalesOrder);
    }
}