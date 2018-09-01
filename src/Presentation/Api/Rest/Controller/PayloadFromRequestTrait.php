<?php


namespace App\Presentation\Api\Rest\Controller;


use Symfony\Component\HttpFoundation\Request;

trait PayloadFromRequestTrait
{
    /**
     * @param Request $request
     * @return array
     */
    private function getPayloadFromRequest(Request $request): array
    {
        $payload = json_decode($request->getContent(), true);

        return $payload ?? [];
    }
}