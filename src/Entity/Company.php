<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 10, unique: true)]
    #[Length(min: 10, max: 10)]
    #[Regex(pattern: '/^\d+$/')]
    private ?string $nip = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 63)]
    private ?string $city = null;

    #[ORM\Column(length: 7)]
    private ?string $postcode = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Employee::class)]
    private Collection $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    /**
     * Get the id of the company.
     *
     * @return int|null The id of the company or null if not set.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the company.
     *
     * @return string|null The name of the company or null if not set.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the company.
     *
     * @param string $name The name of the company.
     * @return static Returns an instance of the current class with the updated name.
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the NIP of the company.
     *
     * @return string|null The NIP of the company or null if not set.
     */
    public function getNip(): ?string
    {
        return $this->nip;
    }

    /**
     * Set the NIP of the company.
     *
     * @param string $nip The NIP of the company.
     * @return static Returns an instance of the current class with the updated NIP.
     */
    public function setNip(string $nip): static
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get the address of the company.
     *
     * @return string|null The address of the company or null if not set.
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set the address of the company.
     *
     * @param string $address The address of the company.
     * @return static Returns an instance of the current class with the updated address.
     */
    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the city of the company.
     *
     * @return string|null The city of the company or null if not set.
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Set the city of the company.
     *
     * @param string $city The city of the company.
     * @return static Returns an instance of the current class with the updated city.
     */
    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the postcode of the company.
     *
     * @return string|null The postcode of the company or null if not set.
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * Set the postcode of the company.
     *
     * @param string $postcode The postcode of the company.
     * @return static Returns an instance of the current class with the updated postcode.
     */
    public function setPostcode(string $postcode): static
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get a collection of employees associated with this company.
     *
     * @return Collection<int, Employee> A collection of Employee objects.
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    /**
     * Add an employee to the company's list of employees.
     *
     * @param Employee $employee The employee to be added.
     * @return static The updated company object.
     */
    public function addEmployee(Employee $employee): static
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setCompany($this);
        }

        return $this;
    }

    /**
     * Remove an employee from the company's list of employees.
     *
     * @param Employee $employee The employee to be removed.
     * @return static The updated company object.
     */
    public function removeEmployee(Employee $employee): static
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getCompany() === $this) {
                $employee->setCompany(null);
            }
        }

        return $this;
    }
}
