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

class Reindex extends Indexer
{
    public function execute()
    {
        $indexerId = $this->getRequest()->getParam('id');
        $indexer = $this->indexerRegistry->get($indexerId);
        if ($indexer->getId()) {
            try {
                $indexer->reindexAll();
                $this->messageManager->addSuccessMessage(__('%1 index was reindex.', $indexer->getTitle()));
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e->getMessage());
            }
        } else {
            $this->messageManager->addErrorMessage(__('Something went wrong'));
        }
        $this->_redirect('indexer/indexer/list');
    }
}
