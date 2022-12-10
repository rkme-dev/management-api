<?php

declare(strict_types=1);

namespace App\Services\CollectionPayments\Resources;

use App\Helpers\InitialisableTrait;
use App\Helpers\Interfaces\Initialisable;
use App\Models\Collection;
use App\Models\CollectionPaymentTypes\PaymentTypeInterface;
use App\Models\User;
use Carbon\Carbon;

final class CreateCollectionPaymentResource implements Initialisable
{
    use InitialisableTrait;

    public Collection $collection;

    public int $accountId;

    public PaymentTypeInterface $type;

    public Carbon $paymentDate;

    public User $createdBy;

    public $amount;

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param  Collection  $collection
     * @return CreateCollectionPaymentResource
     */
    public function setCollection(Collection $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    public function getAccountId(): int
    {
        return $this->accountId;
    }

    public function setAccountId(int $accountId): self
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @return PaymentTypeInterface
     */
    public function getType(): PaymentTypeInterface
    {
        return $this->type;
    }

    /**
     * @param  PaymentTypeInterface  $type
     * @return CreateCollectionPaymentResource
     */
    public function setType(PaymentTypeInterface $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getPaymentDate(): Carbon
    {
        return $this->paymentDate;
    }

    /**
     * @param  Carbon  $paymentDate
     * @return CreateCollectionPaymentResource
     */
    public function setPaymentDate(Carbon $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * @return User
     */
    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    /**
     * @param  User  $createdBy
     * @return CreateCollectionPaymentResource
     */
    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
