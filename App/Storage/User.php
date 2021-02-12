<?php


namespace Liloy\App\Storage;

class User
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $login;
    private string $email;
    private string $phone;
    public function __construct(array $array)
    {
        $this->firstName = $array['first_name'];
        $this->lastName = $array['last_name'];
        $this->id = $array['id'];
        $this->login = $array['login'];
        $this->email = $array['email'];
        $this->phone = $array['phone'];
    }

    /**
     * @return int|mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int|mixed $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param mixed|string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed|string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param mixed|string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed|string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param mixed|string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed|string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed|string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param mixed|string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
