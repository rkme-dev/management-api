<?php

declare(strict_types=1);

namespace App\Services\CollectionPayments\Resources;

use App\Helpers\InitialisableTrait;
use App\Helpers\Interfaces\Initialisable;

final class CreatePaymentTypeResource implements Initialisable
{
    use InitialisableTrait;

    public ?string $bank = null;

    public ?string $bankAccountNumber = null;

    public ?string $checkType = null;

    public ?string $checkNumber = null;

    public ?string $modeOfTransfer = null;

    public ?string $transactionNumber = null;

    /**
     * @return string|null
     */
    public function getBank(): ?string
    {
        return $this->bank;
    }

    /**
     * @param string|null $bank
     * @return CreatePaymentTypeResource
     */
    public function setBank(?string $bank): self
    {
        $this->bank = $bank;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankAccountNumber(): ?string
    {
        return $this->bankAccountNumber;
    }

    /**
     * @param string|null $bankAccountNumber
     * @return CreatePaymentTypeResource
     */
    public function setBankAccountNumber(?string $bankAccountNumber): self
    {
        $this->bankAccountNumber = $bankAccountNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCheckType(): ?string
    {
        return $this->checkType;
    }

    /**
     * @param string|null $checkType
     * @return CreatePaymentTypeResource
     */
    public function setCheckType(?string $checkType): self
    {
        $this->checkType = $checkType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCheckNumber(): ?string
    {
        return $this->checkNumber;
    }

    /**
     * @param string|null $checkNumber
     * @return CreatePaymentTypeResource
     */
    public function setCheckNumber(?string $checkNumber): self
    {
        $this->checkNumber = $checkNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModeOfTransfer(): ?string
    {
        return $this->modeOfTransfer;
    }

    /**
     * @param string|null $modeOfTransfer
     * @return CreatePaymentTypeResource
     */
    public function setModeOfTransfer(?string $modeOfTransfer): self
    {
        $this->modeOfTransfer = $modeOfTransfer;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransactionNumber(): ?string
    {
        return $this->transactionNumber;
    }

    /**
     * @param string|null $transactionNumber
     * @return CreatePaymentTypeResource
     */
    public function setTransactionNumber(?string $transactionNumber): self
    {
        $this->transactionNumber = $transactionNumber;
        return $this;
    }
}
