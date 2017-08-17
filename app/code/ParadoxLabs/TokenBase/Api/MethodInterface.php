<?php
/**
 * Paradox Labs, Inc.
 * http://www.paradoxlabs.com
 * 717-431-3330
 *
 * Need help? Open a ticket in our support system:
 *  http://support.paradoxlabs.com
 *
 * @author      Ryan Hoerr <magento@paradoxlabs.com>
 * @license     http://store.paradoxlabs.com/license.html
 */
namespace ParadoxLabs\TokenBase\Api;

/**
 * Common actions and behavior for TokenBase payment methods
 *
 * @api
 */
interface MethodInterface
{
    /**
     * Set the payment config scope and reinitialize the API
     *
     * @param int $storeId
     * @return $this
     */
    public function setStore($storeId);

    /**
     * Get the current customer; fetch from session if necessary.
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCustomer();

    /**
     * Set the customer to use for payment/card operations.
     *
     * @param \Magento\Customer\Api\Data\CustomerInterface $customer
     * @return $this
     */
    public function setCustomer(\Magento\Customer\Api\Data\CustomerInterface $customer);

    /**
     * Initialize/return the API gateway class.
     *
     * @return \ParadoxLabs\TokenBase\Api\GatewayInterface
     */
    public function gateway();

    /**
     * Get the current card
     *
     * @return \ParadoxLabs\TokenBase\Api\Data\CardInterface
     */
    public function getCard();

    /**
     * Set the current payment card
     *
     * @param \ParadoxLabs\TokenBase\Api\Data\CardInterface $card
     * @return $this
     */
    public function setCard(\ParadoxLabs\TokenBase\Api\Data\CardInterface $card);

    /**
     * @return \Magento\Payment\Model\Info
     */
    public function getInfoInstance();

    /**
     * @param \Magento\Payment\Model\InfoInterface $info
     * @return $this
     */
    public function setInfoInstance(\Magento\Payment\Model\InfoInterface $info);

    /**
     * Order payment abstract method
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param float $amount
     * @return $this
     *
     */
    public function order(\Magento\Payment\Model\InfoInterface $payment, $amount);

    /**
     * Authorize payment abstract method
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param float $amount
     * @return $this
     *
     */
    public function authorize(\Magento\Payment\Model\InfoInterface $payment, $amount);

    /**
     * Capture payment abstract method
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param float $amount
     * @return $this
     *
     */
    public function capture(\Magento\Payment\Model\InfoInterface $payment, $amount);

    /**
     * Refund specified amount for payment
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param float $amount
     * @return $this
     *
     */
    public function refund(\Magento\Payment\Model\InfoInterface $payment, $amount);

    /**
     * Cancel payment abstract method
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @return $this
     *
     */
    public function cancel(\Magento\Payment\Model\InfoInterface $payment);

    /**
     * Void payment abstract method
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @return $this
     *
     */
    public function void(\Magento\Payment\Model\InfoInterface $payment);

    /**
     * Fetch transaction info
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param string $transactionId
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     */
    public function fetchTransactionInfo(\Magento\Payment\Model\InfoInterface $payment, $transactionId);

    /**
     * Retrieve information from payment configuration
     *
     * @param string $field
     * @param int|string|null|\Magento\Store\Model\Store $storeId
     *
     * @return mixed
     */
    public function getConfigData($field, $storeId = null);
}
