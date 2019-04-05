<?php

namespace MindArc\CategoryProductGallery\Helper;

use Magento\Catalog\Model\Product\Gallery\ReadHandler as GalleryReadHandler;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    protected $galleryReadHandler;
    /**
     * Catalog Image Helper
     *
     * @var \Magento\Catalog\Helper\Image
     */
    protected $imageHelper;

    public function __construct(
        GalleryReadHandler $galleryReadHandler,  \Magento\Framework\App\Helper\Context $context,\Magento\Catalog\Helper\Image $imageHelper)
    {
        $this->imageHelper = $imageHelper;
        $this->galleryReadHandler = $galleryReadHandler;
        parent::__construct($context);
    }

    public function getSecondImages(\Magento\Catalog\Api\Data\ProductInterface $product)
    {
        $this->galleryReadHandler->execute($product);/** Add image gallery to $product */
        $images = $product->getMediaGalleryImages();
        if(count($images)>=2){
            $index = 0;
            foreach ($images as $image) {
                $index++;
                if($index==2){
                    /** @var $image \Magento\Catalog\Model\Product\Image */
                    $image->setData(
                        'second_image',
                        $this->imageHelper->init($product, 'category_page_grid') /* check category_page_grid image ratio in app/design/vendor/theme/etc/view.xml */
                            ->constrainOnly(true)->keepAspectRatio(true)->keepFrame(false)
                            ->setImageFile($image->getFile())
                            ->getUrl()
                    );
                    $result = $image;
                    break;
                }
            }
            return $result;
        }else{
            return null;
        }
    }
}