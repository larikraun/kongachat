<?php

class FileUpload
{
    const ERROR = 'error';
    const TYPE = 'type';
    const NAME = 'name';
    const SIZE = 'size';
    const TMP_NAME = 'tmp_name';
    const MAX_SIZE = 10485760; //10MB
    const STATUS_OK = 1;
    const STATUS_ERROR = 2;
    const STATUS_DISALLOWED_MIME_TYPE = 3;
    const STATUS_DISALLOWED_EXT = 4;
    const STATUS_FILE_EXISTS = 5;
    const STATUS_MAX_SIZE_EXCEEDED = 6;
    const DIMENSION_MISMATCH = 7;
    const STATUS_NO_FILE_UPLOADED = 8;
    public static $video_extensions = array("mp4", "flv", "wmv", "avi");
    public static $video_mime_types = array("video/mp4", "video/x-flv", "video/x-ms-wmv", "video/x-msvideo");
    public static $image_extensions = array("jpg", "png");
    public static $image_mime_types = array("image/jpeg", "image/png");
    private $allowed_exts;
    private $allowed_mime;
    private $file_input_name;
    private $max_size;
    private $index;

    public function __construct($file_input_name, $allowed_exts, $allowed_mime, $max_size = NULL, $index = -1)
    {
        $this->file_input_name = $file_input_name;
        $this->allowed_exts = $allowed_exts;
        $this->allowed_mime = $allowed_mime;
        if ($index != -1) {
            $this->index = $index;
        }
        $this->max_size = ($max_size != NULL) ? $max_size : FileUpload::MAX_SIZE;
    }

    public function saveFile($file_name, $dir_path)
    {
        $dir_path = ($dir_path[strlen($dir_path) - 1] == '/') ? $dir_path : $dir_path . '/';
        if ($this->fileExists($file_name, $dir_path)) {
            return FileUpload::STATUS_FILE_EXISTS;
        } else if ($this->hasAllowedMimeType()) {
            return FileUpload::STATUS_DISALLOWED_MIME_TYPE;

        } else if ($this->hasAllowedExt()) {
            return FileUpload::STATUS_DISALLOWED_EXT;
        } else if ($this->hasExceededMaxSize()) {
            return FileUpload::STATUS_MAX_SIZE_EXCEEDED;
        } else {
            if ($this->index == -1) {
                move_uploaded_file($_FILES[$this->file_input_name][FileUpload::TMP_NAME], $dir_path . $file_name);
            } else {
                move_uploaded_file($_FILES[$this->file_input_name][FileUpload::TMP_NAME][$this->index], $dir_path . $file_name);
            }

            return FileUpload::STATUS_OK;
        }

    }

    private function fileExists($file_name, $dir_path)
    {
        return file_exists($dir_path . $file_name);
    }

    private function hasAllowedMimeType()
    {
        return ($this->index == -1) ? in_array($_FILES[$this->file_input_name][FileUpload::NAME], $this->allowed_mime) : in_array($_FILES[$this->file_input_name][FileUpload::NAME][$this->index], $this->allowed_mime);
    }

    private function hasAllowedExt()
    {
        $temp = ($this->index == -1) ? explode('.', $_FILES[$this->file_input_name][FileUpload::NAME]) : explode('.', $_FILES[$this->file_input_name][FileUpload::NAME][$this->index]);
        return in_array(end($temp), $this->allowed_mime);
    }

    private function hasExceededMaxSize()
    {
        return ($this->index == -1) ? ($_FILES[$this->file_input_name][FileUpload::SIZE] > FileUpload::MAX_SIZE) : ($_FILES[$this->file_input_name][FileUpload::SIZE][$this->index] > FileUpload::MAX_SIZE);
    }


}