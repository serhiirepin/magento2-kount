<?php
/**
 * Copyright (c) 2017 KOUNT, INC.
 * See COPYING.txt for license details.
 */
namespace Swarming\Kount\Model\Ens\EventHandler;

use Swarming\Kount\Model\Ens\EventHandlerInterface;

class NotesAdd extends EventHandlerOrder implements EventHandlerInterface
{
    const EVENT_NAME = 'WORKFLOW_NOTES_ADD';

    /**
     * @var \Swarming\Kount\Model\Logger
     */
    private $logger;

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @param \Swarming\Kount\Model\Logger $logger
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        \Swarming\Kount\Model\Logger $logger,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        $this->logger = $logger;
        $this->orderFactory = $orderFactory;
        $this->orderRepository = $orderRepository;
        parent::__construct($orderFactory);
    }

    /**
     * @param \Magento\Framework\Simplexml\Element $event
     */
    public function process($event)
    {
        list($transactionId, $orderId, $oldValue, $newValue) = $this->fetchVars($event);

        $this->logger->info('ENS Event Details');
        $this->logger->info('Name: ' . self::EVENT_NAME);
        $this->logger->info('order_number: ' . $orderId);
        $this->logger->info('transaction_id: ' . $transactionId);
        $this->logger->info('old_value: ' . $oldValue);
        $this->logger->info('new_value: ' . $newValue[0]);
        $this->logger->info('agent: ' . $event->agent);
        $this->logger->info('occurred: ' . $event->occurred);

        $newComment = "Reason Code: " . $newValue['@']['reason_code'] . "<br>"
                      . "Comment: " . $newValue[0];

        $order = $this->loadOrder($orderId);
        $order->addCommentToStatusHistory($newComment);
        $this->orderRepository->save($order);
    }
}
