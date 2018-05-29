<?php
/**
* This class Search images from external url
* It works with SIMPLE HTML DOM PARSER
*
* @author Barnaproject <info@barnaproject.com>
* @license MIT
*/
ini_set('max_execution_time', 300);
error_reporting(E_ALL ^ E_NOTICE);
//required simple_html_dom.php
require_once('includes/simple_html_dom.php');

class Imager {
    /**
     * @var string
     */ 
    var $web;
    /**
     * @var array
     */ 
    var $imgArr;
    /**
     * @var null
     */ 
    var $url = null;

    public function __construct()
    {
        $this->web = $site;
        $this->imgArr = $imgs;
    }

    /**
     * Get images from current page use SIMPLE HTML DOM PARSER
     *
     *@param
     * $url => url content
     * $result => url
     * $images => all images
     * $element->src => url in foreach
     * $html => content html array result
     *
     * @return array
     */
    public function get_images($site)
    {
        $data = file_get_html($site);
        $url = new simple_html_dom();
        $url->load($data);

        $result = parse_url($site);

        $images = [];

        if($url != null)
        {
            foreach($url->find('img') as $element){
                $img = $element->src;
                if(!in_array($img, $images))
                {
                    if(strpos($img, 'http') !== false)
                    {
                        $img = $element->src;
                    }else{
                        $img = $result['scheme'].'://'.$result['host'].'/'.$element->src;
                    }
                    $file_headers = @get_headers($img);
                    if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
                        $exists = false;
                    }
                    else {
                        $exists = true;
                    }
                    if($exists == true)
                    {
                        list($width, $height) = @getimagesize($img);
                        $ext = pathinfo($img, PATHINFO_EXTENSION);
                        $ext = substr($ext, 0, 3);
                        $ext = str_replace('jpeg', 'jpg', $ext);
                        $html = '<tr>';
                        $html .= '<td class="item" data-exist="'.(!empty($ext)?'1':'0').'"><a href="'.$img.'" data-lightbox="roadtrip"><img style="width:50px" src="'.$img.'"></a></td>';
                        $html .= '<td>'.(!empty($width)?$width.'px':'...').'</td>';
                        $html .= '<td>'.(!empty($height)?$height.'px':'...').'</td>';
                        $html .= '<td>'.(!empty($ext)?$ext:'<span class="glyphicon glyphicon-info-sign info-span" aria-hidden="true" data-toggle="modal" data-target="#info-modal"></span>').'</td>';
                        $html .= '<td>'.$img.'</td>';
                        $html .= '<td><a class="btn btn-success" href="'.$img.'" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a></td>';
                        $html .= '</tr>';
                        echo $html;
                        array_push($images, $img);
                    }else{
                        continue;
                    }
                }else{
                    continue;
                }
            }
        }

    }

    /**
     * Limit url characters
     *
     * @return string
     */
    public function short_url($site)
    {
        return (strlen($site)>30)?substr($site,0,30).'...':$site;
    }

    /**
     * Create folder + zip folder
     *
     *@param
     * $path => time
     * $imgs => image array
     * $images => all images
     * $rootPath => current path
     * $newFIle => current zip
     *
     * @return string
     */
    public function download_images($imgs)
    {
        $path = time();
        if (!file_exists('./downloads/'.$path)) {
            mkdir("./downloads/".$path, 0777, true);
        }
        $i = 0;

        foreach($imgs as $img){
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            $ext = substr($ext, 0, 3);
            $ext = str_replace('jpeg', 'jpg', $ext);
            if(!empty($ext))
            {
                copy($img, 'downloads/'.$path.'/'.$i.'.'.$ext);
                $i++;
            }
        }

        $rootPath = realpath('downloads/'.$path);

        $zip = new ZipArchive();

        $zip->open('downloads/'.$path.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $filesToDelete = array();

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            if (!$file->isDir())
            {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                $zip->addFile($filePath, $relativePath);

                $filesToDelete[] = $filePath;
            }
        }

        $zip->close();

        foreach ($filesToDelete as $file)
        {
            unlink($file);
        }
        rmdir($rootPath);

        $newFIle = 'downloads/'.$path.'.zip';

        $this->download($newFIle);
    }

    /**
     * Download zip folder + remove current file
     *
     * @return string
     */
    private function download($newFIle)
    {
        header("Content-type: application/zip");
        header('Content-Disposition: attachment; filename="'.basename($newFIle).'"');
        header("Content-length: " . filesize($newFIle));
        header("Pragma: no-cache");
        header("Expires: 0");
        ob_clean();
        flush();
        readfile($newFIle);
        unlink($newFIle);
        exit;
    }
}