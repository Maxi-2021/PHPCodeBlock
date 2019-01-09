<?
    $f = 'f:/www/docs';
    $obj = new COM ( 'scripting.filesystemobject' );
    if ( is_object ( $obj ) )
    {
        $ref = $obj->getfolder ( $f );
        echo 'Directory: ' . $f . ' => Size: ' . $ref->size;
        $obj = null;
    }
    else
    {
        echo 'can not create object';
    }
?>
