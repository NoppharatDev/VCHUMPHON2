<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/Package.Class.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/Product.Class.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/Blog.Class.php");

    $pkgObj = new Package();
    $prodObj = new Product();
    $blogObj = new Blog();

    date_default_timezone_set('Asia/Bangkok');
    $dom     = new \DOMDocument('1.0');
    $urlset = $dom->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
    $urlset->setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
    $urlset->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
    $urlset = $dom->appendChild($urlset);
    $url = $dom->createElement('url');
    $urlset->appendChild($url);

    ### Index ###
    $loc = $dom->createElement('loc', 'https://vchumphon.com/');
    $lastmod = $dom->createElement('lastmod', date("Y-m-d"));
    $changefreq = $dom->createElement('changefreq', 'daily');
    $priority = $dom->createElement('priority', '1.0');
    $url->appendChild($loc);
    $url->appendChild($lastmod);
    $url->appendChild($changefreq);
    $url->appendChild($priority);

    ### Travel ###
    $url = $dom->createElement('url');
    $urlset->appendChild($url);
    $loc = $dom->createElement('loc', "https://vchumphon.com/travel");
    $lastmod = $dom->createElement('lastmod', date("Y-m-d"));
    $changefreq = $dom->createElement('changefreq', 'daily');
    $priority = $dom->createElement('priority', '0.75');
    $url->appendChild($loc);
    $url->appendChild($lastmod);
    $url->appendChild($changefreq);
    $url->appendChild($priority);
    $result = $pkgObj->queryPackages(); $i = 1;
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $url = $dom->createElement('url');
            $urlset->appendChild($url);
            $loc = $dom->createElement('loc', "https://vchumphon.com/travel/{$row['pkg_id']}");
            $lastmod = $dom->createElement('lastmod', $row['pkg_updated']);
            $changefreq = $dom->createElement('changefreq', 'daily');
            $priority = $dom->createElement('priority', '0.7');

            $url->appendChild($loc);
            $url->appendChild($lastmod);
            $url->appendChild($changefreq);
            $url->appendChild($priority);
        }
    }

    ### Robusta ###
    $url = $dom->createElement('url');
    $urlset->appendChild($url);
    $loc = $dom->createElement('loc', "https://vchumphon.com/robusta");
    $lastmod = $dom->createElement('lastmod', date("Y-m-d"));
    $changefreq = $dom->createElement('changefreq', 'daily');
    $priority = $dom->createElement('priority', '0.75');
    $url->appendChild($loc);
    $url->appendChild($lastmod);
    $url->appendChild($changefreq);
    $url->appendChild($priority);
    $result = $prodObj->queryProducts(); $i = 1;
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $url = $dom->createElement('url');
            $urlset->appendChild($url);
            $loc = $dom->createElement('loc', "https://vchumphon.com/robusta/{$row['prod_id']}");
            $lastmod = $dom->createElement('lastmod', $row['prod_updated']);
            $changefreq = $dom->createElement('changefreq', 'daily');
            $priority = $dom->createElement('priority', '0.7');

            $url->appendChild($loc);
            $url->appendChild($lastmod);
            $url->appendChild($changefreq);
            $url->appendChild($priority);
        }
    }

    ### Product ###
    $url = $dom->createElement('url');
    $urlset->appendChild($url);
    $loc = $dom->createElement('loc', "https://vchumphon.com/product");
    $lastmod = $dom->createElement('lastmod', date("Y-m-d"));
    $changefreq = $dom->createElement('changefreq', 'daily');
    $priority = $dom->createElement('priority', '0.75');
    $url->appendChild($loc);
    $url->appendChild($lastmod);
    $url->appendChild($changefreq);
    $url->appendChild($priority);
    $result = $prodObj->queryPartnerProducts(); $i = 1;
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $url = $dom->createElement('url');
            $urlset->appendChild($url);
            $loc = $dom->createElement('loc', "https://vchumphon.com/product/{$row['prod_id']}");
            $lastmod = $dom->createElement('lastmod', $row['prod_updated']);
            $changefreq = $dom->createElement('changefreq', 'daily');
            $priority = $dom->createElement('priority', '0.7');

            $url->appendChild($loc);
            $url->appendChild($lastmod);
            $url->appendChild($changefreq);
            $url->appendChild($priority);
        }
    }

    ### Blog ###
    $url = $dom->createElement('url');
    $urlset->appendChild($url);
    $loc = $dom->createElement('loc', "https://vchumphon.com/content");
    $lastmod = $dom->createElement('lastmod', date("Y-m-d"));
    $changefreq = $dom->createElement('changefreq', 'daily');
    $priority = $dom->createElement('priority', '0.7');
    $url->appendChild($loc);
    $url->appendChild($lastmod);
    $url->appendChild($changefreq);
    $url->appendChild($priority);
    $result = $blogObj->queryBlogs(); $i = 1;
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $url = $dom->createElement('url');
            $urlset->appendChild($url);
            $loc = $dom->createElement('loc', "https://vchumphon.com/content/{$row['blog_id']}");
            $lastmod = $dom->createElement('lastmod', date("Y-m-d"));
            $changefreq = $dom->createElement('changefreq', 'daily');
            $priority = $dom->createElement('priority', '0.65');

            $url->appendChild($loc);
            $url->appendChild($lastmod);
            $url->appendChild($changefreq);
            $url->appendChild($priority);
        }
    }
    
    $status = $dom->save("sitemap.xml");
?>