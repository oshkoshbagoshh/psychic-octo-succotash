<?php

namespace Client; // Replace with your actual namespace

/**
 * Class Client
 * Represents a client with metadata for content management.
 */
class Client
{
    private array $data;

    // Constants for content types and formats
    private const CONTENT_TYPE_MARKDOWN = "markdown articles";
    private const FILE_FORMAT_MARKDOWN = "markdown";
    private const UPLOAD_LOCATION_WORDPRESS = "wordpress";

    /**
     * Client constructor.
     *
     * @param int $accountNumber
     * @param string $contact
     * @param string $content
     * @param string|null $signupDate
     */
    public function __construct(int $accountNumber, string $contact, string $content, ?string $signupDate = null)
    {
        $this->data = [
            "content_type" => self::CONTENT_TYPE_MARKDOWN,
            "file_format" => self::FILE_FORMAT_MARKDOWN,
            "upload_location" => self::UPLOAD_LOCATION_WORDPRESS,
            "content" => $content,
            "account_number" => $accountNumber,
            "contact" => $contact,
            "signup_date" => $signupDate ?? date('Y-m-d'),
        ];
    }

    /**
     * Get the client data.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Validate the email format.
     *
     * @param string $email
     * @return bool
     */
    private function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Set the contact email with validation.
     *
     * @param string $contact
     * @throws InvalidArgumentException
     */
    public function setContact(string $contact): void
    {
        if (!$this->isValidEmail($contact)) {
            throw new \InvalidArgumentException("Invalid email format.");
        }
        $this->data['contact'] = $contact;
    }
}
