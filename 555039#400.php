$a = simplexml_load_string('<root></root>');
$a->b = 'This is a non-breaking space  ';
$a->addChild('c','This is a non-breaking space  ');    
print $a->asXML();
