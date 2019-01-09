// return mime type ala mimetype extension
$finfo = finfo_open(FILEINFO_MIME);

//check to see if the mime-type starts with 'text'
return substr(finfo_file($finfo, $filename), 0, 4) == 'text';
