<?php
namespace App\Core\Domain\Message;

final class CreateSalesOrder
{
    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $title;

    public function __construct(string $customerId, string $title)
    {
        $this->customerId = $customerId;
        $this->title = $title;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}