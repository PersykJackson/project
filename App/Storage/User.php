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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed|string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

}
