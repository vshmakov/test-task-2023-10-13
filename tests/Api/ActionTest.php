<?php

declare(strict_types=1);

namespace App\Tests\Api;

use App\Enums\HttpMethod;
use App\Enums\HttpStatusCode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Webmozart\Assert\Assert;

abstract class ActionTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->createClient();
    }

    final public function testAction(): void
    {
        $this->prepareData();
        $this->requestApi(
            $this->getMethod(),
            $this->getUrl(),
            $this->getQuery(),
            $this->getBody(),
            $this->getHeaders()
        );
        $this->assertResponseStatusCodeSame($this->getExpectedStatusCode()->value);
        $this->assertResult();
    }

    protected function prepareData(): void
    {
    }

    abstract protected function getUrl(): string;

    abstract protected function getMethod(): HttpMethod;

    /**
     * @return array<string,string>
     */
    protected function getHeaders(): array
    {
        return [
            'CONTENT_TYPE' => 'application/json',
            'ACCEPT' => 'application/json',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    protected function getQuery(): array
    {
        return [];
    }

    /**
     * @return array<string,mixed>|null
     */
    protected function getBody(): ?array
    {
        return null;
    }

    protected function getExpectedStatusCode(): HttpStatusCode
    {
        return HttpStatusCode::OK;
    }

    protected function assertResult(): void
    {
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        $entityManager = $this->getContainer()
            ->get('doctrine.orm.entity_manager')
        ;
        Assert::isInstanceOf($entityManager, EntityManagerInterface::class);

        return $entityManager;
    }

    /**
     * @template T of object
     *
     * @param class-string<T>      $entityClass
     * @param array<string, mixed> $criteria
     *
     * @return T
     */
    protected function requireOneBy(string $entityClass, array $criteria): object
    {
        $entity = $this->getEntityManager()
            ->getRepository($entityClass)
            ->findOneBy($criteria)
        ;
        $this->assertNotNull($entity);

        return $entity;
    }

    /**
     * @return mixed[]
     */
    protected function getJsonResponseData(): array
    {
        $content = $this->client
            ->getResponse()
            ->getContent()
        ;
        Assert::notFalse($content);
        $this->assertJson($content);
        $data = json_decode($content, true);
        $this->assertIsArray($data);

        return $data;
    }

    /**
     * @param array<string, mixed>      $query
     * @param array<string, mixed>|null $body
     * @param array<string, string>     $headers
     */
    private function requestApi(HttpMethod $method, string $uri, array $query, ?array $body, array $headers): void
    {
        $content = null !== $body ? json_encode($body) : null;
        Assert::notFalse($content);

        $this->client
            ->request(
                $method->name,
                $uri,
                $query,
                [],
                $headers,
                $content
            )
        ;
        $this->styleJsonResponse();
    }

    private function styleJsonResponse(): void
    {
        $response = $this->client->getResponse();
        $content = $response->getContent();

        if (false === $content) {
            return;
        }

        if ($this->isValidJson($content)) {
            $json = json_encode(json_decode($content), \JSON_PRETTY_PRINT);
            Assert::notFalse($json);
            $response->setContent($json);
        }
    }

    private function isValidJson(string $json): bool
    {
        json_decode($json);

        return !json_last_error();
    }
}
