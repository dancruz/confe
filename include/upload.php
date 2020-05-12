<?php
class Upload {
    var $maxsize = 0;
    var $message = "";
    var $newfile = "";
    var $newpath = "";
   
    var $filesize = 0;
    var $filetype = "";
    var $filename = "";
    var $filetemp;
    var $fileexte;
   
    var $allowed;
    var $blocked;
    var $isimage;
    var $isupload;
   
    function Upload() {
        $this->allowed = array("image/bmp","image/gif","image/jpeg","image/pjpeg","image/png","image/x-png");
        $this->blocked = array("php","phtml","php3","php4","js","shtml","pl","py");
        $this->message = "";
        $this->isupload = false;
    }
    function setFile($field) {
        $this->filesize = $_FILES[$field]['size'];
        $this->filename = $_FILES[$field]['name'];
        $this->filetemp = $_FILES[$field]['tmp_name'];
        //$this->filetype = mime_content_type($this->filetemp);
        $this->fileexte = substr($this->filename, strrpos($this->filename, '.')+1);
       
        $this->newfile = substr($this->filename,0,strrpos($this->filename, '.')).substr(md5(uniqid(rand())),0,8).".".$this->fileexte;
    }
    function setPath($value) {
        $this->newpath = $value;
    }
    function setMaxSize($value) {
        $this->maxsize = $value;   
    }
    function isImage($value) {
        $this->isimage = $value;
    }
    function save() {
        if (is_uploaded_file($this->filetemp)) {
            // check if file valid
            if ($this->filename == "") {
                $this->message = "No se subio el archivo";
                $this->isupload = false;
                return false;
            }
            // check max size
            if ($this->maxsize != 0) {
                if ($this->filesize> $this->maxsize*1024) {
                    $this->message = "Excede de tama&ntilde;o";
                    $this->isupload = false;
                    return false;
                }
            }
            // check if image
            if ($this->isimage) {
                // check dimensions
                if (!getimagesize($this->filetemp)) {
                    $this->message = "Archivo de Imagen no permitido";
                    $this->isupload = false;
                    return false;   
                }
                // check content type
                if (!in_array($this->filetype, $this->allowed)) {
                    $this->message = "Tipo de contenido no permitido";
                    $this->isupload = false;
                    return false;
                }
            }
            // check if file is allowed
            if (in_array($this->fileexte, $this->blocked)) {
                $this->message = "Archivo no admiten - ".$this->fileexte;
                $this->isupload = false;
                return false;
            }
                   
            if (move_uploaded_file($this->filetemp, $this->newpath."/".$this->newfile)) {
                $this->message = "Archivo subido correctamente!";
                $this->isupload = true;
                return true;
            } else {
                $this->message = "El archivo no se ha subido por favor intentelo de nuevo";
                $this->isupload = false;
                return false;
            }
        } else {
            $this->message = "El archivo no se ha subido por favor intentelo de nuevo";
            $this->isupload = false;
            return false;
        }
    }   
}
?>