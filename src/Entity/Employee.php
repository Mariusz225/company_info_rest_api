<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Email;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    private ?Company $company = null;

    #[ORM\Column(length: 31)]
    private ?string $name = null;

    #[ORM\Column(length: 63)]
    private ?string $surname = null;

    #[ORM\Column(length: 127, unique: true)]
    #[Email]
    private ?string $email = null;

    #[ORM\Column(length: 15, unique: true, nullable: true)]
    private ?string $phoneNumber = null;

    /**
     * Get the id of the employee.
     *
     * @return int|null The id of the employee or null if not set.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the company of the employee.
     *
     * @return Company|null The company of the employee or null if not set.
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * Set the company of the employee.
     *
     * @param Company|null $company The company of the employee.
     * @return static Returns an instance of the current class with the updated company.
     */
    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get the name of the employee.
     *
     * @return string|null The name of the employee or null if not set.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the employee.
     *
     * @param string $name The name of the employee.
     * @return static Returns an instance of the current class with the updated name.
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the surname of the employee.
     *
     * @return string|null The surname of the employee or null if not set.
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * Set the surname of the employee.
     *
     * @param string $surname The surname of the employee.
     * @return static Returns an instance of the current class with the updated surname.
     */
    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the email of the employee.
     *
     * @return string|null The email of the employee or null if not set.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the email of the employee.
     *
     * @param string $email The email of the employee.
     * @return static Returns an instance of the current class with the updated email.
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the phone number of the employee.
     *
     * @return string|null The phone number of the employee or null if not set.
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * Set the phone number of the employee.
     *
     * @param string $phoneNumber The phone number of the employee.
     * @return static Returns an instance of the current class with the updated phone number.
     */
    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
