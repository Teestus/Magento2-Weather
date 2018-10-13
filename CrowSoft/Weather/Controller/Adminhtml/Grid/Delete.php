<?php
/**
 * @author    Leszek Kruk
 */

namespace CrowSoft\Weather\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use CrowSoft\Weather\Api\LublinWeatherRepositoryInterface;
use CrowSoft\Weather\Logger\Logger;
use Magento\Framework\Message\ManagerInterface as MessageManager;

/**
 * Class Delete
 *
 * @package CrowSoft\Weather\Controller\Adminhtml\Grid
 */
class Delete extends Action
{
    /** Grid Route */
    const GRID_ROUTE = 'weather/grid/index';

    /** @var LublinWeatherRepositoryInterface */
    protected $lublinWeatherRepository;

    /** @var Logger */
    protected $logger;

    /** @var MessageManager  */
    protected $messageManager;

    /**
     * Delete constructor.
     *
     * @param Context                          $context
     * @param LublinWeatherRepositoryInterface $lublinWeatherRepository
     * @param Logger                           $logger
     * @param MessageManager                   $messageManager
     */
    public function __construct(
        Context $context,
        LublinWeatherRepositoryInterface $lublinWeatherRepository,
        Logger $logger,
        MessageManager $messageManager
    ) {
        $this->lublinWeatherRepository = $lublinWeatherRepository;
        $this->logger                  = $logger;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        try {
            $this->lublinWeatherRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(_('Row deleted Successfully'));
            $this->_redirect(self::GRID_ROUTE);

        } catch (\Exception $e) {
            $this->logger->addError($e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->_redirect(self::GRID_ROUTE);
        }
    }
}
