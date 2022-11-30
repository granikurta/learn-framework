<?php


namespace Component\Http;


class Response
{
    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_ACCEPTED = 202;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_NOT_FOUND = 404;

    /**
     * @var string[] statusTexts
     */
    public $statusTexts = [
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        204 => 'No Content',
        400 => 'Bad Request',
        404 => 'Not Found'
    ];

    /**
     * @var int
     */
    protected int $statusCode;

    /**
     * @var string|null
     */
    public ?string $content;

    /**
     * @var string
     */
    private string $statusText;

    protected array $headers;

    public function __construct(?string $content = '', int $status = 200, $headers = ['Content-Type: text/html'])
    {
        $this->setContent($content);
        $this->setStatusCode($status);
        $this->headers = $headers;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content ?? '';
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
        $this->statusText = $this->statusTexts[$statusCode] ?? 'unknown status';
    }

    /**
     * @return $this
     */
    private function sendHeaders(): static
    {
        if (headers_sent()) {
            return $this;
        }
        foreach ($this->headers as $header) {
            header($header);
        }
        header(sprintf('HTTP/1.1 %s %s', $this->statusCode, $this->statusText), true, $this->statusCode);
        return $this;
    }

    /**
     * @return void
     */
    private function sendContent(): void
    {
        echo $this->content;
    }

    /**
     * @return $this
     */
    public function send(): static
    {
        $this->sendHeaders();
        $this->sendContent();
        return $this;
    }

}