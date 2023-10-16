<?php

declare(strict_types=1);

namespace App\Tests\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Webmozart\Assert\Assert;

use function Symfony\Component\String\u;

abstract class ActionTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();


        $this->client = $this->createClient();
        $this->getEntityManager()->beginTransaction();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->getEntityManager()->rollback();
    }

    final public function testAction(): void
    {
        $this->prepareData();
        $this->requestApi(
            $this->getMethod(),
            $this->getUrl(),
            $this->getQuery(),
            $this->getBody(),
            $this->getServerFormattedHeaders()
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
        return [];
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
        return $this->getContainer()
            ->get('doctrine.orm.entity_manager');
    }

    /**
     * @return array<string, string>
     */
    private function getServerFormattedHeaders(): array
    {
        $headers = $this->getHeaders();
        $headerKeys = array_map(static fn(string $header): string => u($header)->ensureStart('HTTP_')->toString(), array_keys($headers));
        $headers = array_combine($headerKeys, $headers);
        Assert::notFalse($headers);

        return $headers;
    }

    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed>|null $body
     * @param array<string, string> $headers
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
            );
    }
}
