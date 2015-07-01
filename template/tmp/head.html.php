<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>datos.uchile.cl</title>
<?php  if( $require_base ) {  ?>
<base href="http://datos.uchile.cl/">
<?php  }  ?>
<link rel="stylesheet" type="text/css" href="d/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="d/css/style.css">
<link rel="stylesheet" type="text/css" href="d/css/timeline.css">
<script type="text/javascript" src="d/js/jquery.min.js"></script>
</head>
<body id="page-top" data-spy="scroll" data-target="#spyme">
<nav class="navbar navbar-fixed-top">
  <div id="logo-header" class="col-xs-6 col-sm-3"><a class="page-scroll" href="<?php print $is_index?'#page-top':'http://datos.uchile.cl'; ?>">datos.uchile.cl</a></div>
  <div id="buscador-principal" class="col-md-4 col-lg-5 hidden-xs hidden-sm">
    <div class="input-group">
      <input type="text" class="form-control typeahead" placeholder="Buscar...">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </span>
    </div>
  </div>
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button> 
  </div>
  <div class="navbar-collapse collapse navbar-right col-xs-6 col-sm-4" aria-expanded="false" style="height: 1px;">
    <ul class="nav navbar-nav">
      <li><a href="#">Ontologías</a></li>
      <li><a href="sparql">EndPoint Sparql</a></li>
      <li><a href="#">Sobre El Sitio</a></li>
    </ul>
  </div>
</nav>
