# Magento2 Get second product image in category page

You can call $product->getMediaGalleryImages() in product page directly, 
however in category page this method is not available by default.

## How to install
1. Cope code to app/code
2. enable module

## How to use

In category template: Magento_Catalog/templates/product/list.phtml

#### 1. define helper outside "foreach ($_productCollection as $_product)"
```
$_backImageHelper = $this->helper('MindArc\CategoryProductGallery\Helper\Data');
```
#### 2. get second image for each product inside "foreach ($_productCollection as $_product)"
```
$_backImageHelper->addGallery($_product);
$backImageUrl = $_backImageHelper->getSecondImages($_product)['second_image'];
 <?php if($backImageUrl):?>
      <img class="product-image-photo hover-image" src="<?php echo $backImageUrl; ?>" />
<?php endif;?>
```

