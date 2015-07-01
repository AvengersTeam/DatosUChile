<?php
require( 'config.php' );
header( 'Content-type: application/json' );
echo '{  
  "timeline": {
    "headline":"The Main Timeline Headline Goes here",
    "type":"default",
    "text":"<p>Intro body text goes here, some HTML is ok</p>",
    "date": [
      {
        "startDate":"2011,12,10,07,02,10",
        "endDate":"2011,12,11,08,11",
        "headline":"Headline Goes Here",
        "text":"<p>Body text goes here, some HTML is OK</p>",
        "tag":"This is Optional",
        "classname":"optionaluniqueclassnamecanbeaddedhere"
      }
    ],
    "era": [
      {
        "startDate":"2011,12,10",
        "endDate":"2014,12,11",
        "headline":"Headline Goes Here",
        "text":"<p>Body text goes here, some HTML is OK</p>",
        "tag":"This is Optional"
      }
    ]
  }
}';
