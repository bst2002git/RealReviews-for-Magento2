# RealReviews for Magento2 - improve review quality

Add a amazon-like "Verified review" label to reviews of customers. 

![bildschirmfoto 2017-03-31 um 09 41 59](https://cloud.githubusercontent.com/assets/13021579/24541145/89d15fc8-15f6-11e7-9712-6b3de0a9a3a3.png)

This module will add an label after the review if the customer is logged in and has bought the item he is reviewing. This way you can improve reviews quality, as the customer now can differ from real reviews and "fake" reviews.

### Disable guest reviews

The module works best if you deactivate the guest review. This way you will have the `customer_id` used, which is needed for the plugin to work. 


### Installation

1. Download ZIP File from GitHub
2. Add content of ZIP to your Magento Root
3. enable and upgrade: `$ php bin/magento module:enable MS_RealReviews && php bin/magento setup:upgrade`
4. Clear cache and check frontend

### No backend settings

The module injects itself into Magento2 automatically. All you have to do is to install and enable the module correctly.

### Easy to modify

The module does a simple Truefalse-Check. You can modify modules output to your needs. Simply create a new folder, called `MS_RealReviews` in your theme and modify the `.phtml`-File as you wish in it.  
