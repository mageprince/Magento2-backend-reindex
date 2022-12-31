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

namespace Mageprince\BackendReindex\Block\Adminhtml\Indexer;

use Magento\Backend\Block\Context;
use Magento\Framework\DataObject;
use Magento\Framework\UrlInterface;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;

class Action extends AbstractRenderer
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param Context $context
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Render reindex and reset
     *
     * @param DataObject $row
     * @return \Magento\Framework\Phrase|string
     */
    public function render(DataObject $row)
    {
        $indexerId = $row->getIndexerId();
        $reindexUrl = $this->urlBuilder->getUrl('mpreindex/indexer/reindex', ['id' => $indexerId]);
        $resetUrl = $this->urlBuilder->getUrl('mpreindex/indexer/reset', ['id' => $indexerId]);
        return __('<a href="%1">Reindex</a> || <a href="%2">Reset</a>', $reindexUrl, $resetUrl);
    }
}
