<?php
/**
 * MagePrince
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the mageprince.com license that is
 * available through the world-wide-web at this URL:
 * https://mageprince.com/end-user-license-agreement
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    MagePrince
 * @package     Mageprince_BackendReindex
 * @copyright   Copyright (c) MagePrince (https://mageprince.com/)
 * @license     https://mageprince.com/end-user-license-agreement
 */

namespace Mageprince\BackendReindex\Controller\Adminhtml\Indexer;

use Mageprince\BackendReindex\Controller\Adminhtml\Indexer;

class MassReset extends Indexer
{
    public function execute()
    {
        $indexerIds = $this->getRequest()->getParam('indexer_ids');
        if (!is_array($indexerIds)) {
            $this->messageManager->addErrorMessage(__('Please select indexers.'));
        } else {
            try {
                foreach ($indexerIds as $indexerId) {
                    $model = $this->indexerRegistry->get($indexerId);
                    $state = $model->getState();
                    $state->setStatus(\Magento\Framework\Indexer\StateInterface::STATUS_INVALID)->save();
                }
                $this->messageManager->addSuccessMessage(
                    __('%1 indexer(s) were reset.', count($indexerIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        $this->_redirect('indexer/indexer/list');
    }
}
