<?php
namespace App\Presentation\Api\Rest\Controller;

use App\Core\Domain\Message\CreateSalesOrder;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class PurchaseOrderController extends Controller
{
    use PayloadFromRequestTrait;

    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @Route("purchaseOrder", name="api_post_purchase_order", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function postPurchaseOrder(Request $request): JsonResponse
    {
        $payload = $this->getPayloadFromRequest($request);
        $customerId = $payload['customerId'] ?? '';
        $title = $payload['title'] ?? '';

        try {
            Assertion::notEmpty($customerId);
            Assertion::notEmpty($title);

            $this->messageBus->dispatch(new CreateSalesOrder($customerId, $title));
        } catch (AssertionFailedException $e) {
            return JsonResponse::create(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return JsonResponse::create(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return JsonResponse::create(null, Response::HTTP_ACCEPTED);
    }
}