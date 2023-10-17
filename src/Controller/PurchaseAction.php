<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApiResource\Purchase;
use App\Enums\HttpMethod;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
#[Route('/purchase', methods: HttpMethod::POST->name)]
final readonly class PurchaseAction
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $purchase = $this->serializer->deserialize(
            $request->getContent(),
            Purchase::class,
            JsonEncoder::FORMAT
        );
        $violations = $this->validator->validate($purchase);

        if (0 !== \count($violations)) {
            foreach ($violations as $violation) {
                dd($violation->getPropertyPath(), $violation->getMessage());
            }
        }

        return new JsonResponse();
    }
}
