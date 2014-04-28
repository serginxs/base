<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    
    <?php foreach ($items as $item): ?>
        <?php foreach ($item['models'] as $model): ?>
            <url>
                <loc><?php echo CHtml::encode($model['url']); ?></loc>            
                <changefreq><?php echo $item['changefreq']; ?></changefreq>
                <priority><?php echo $item['priority']; ?></priority>
            </url>
        <?php endforeach; ?>
    <?php endforeach; ?>
</urlset>