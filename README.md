# DatosUChile
Sitio web de datos abiertos enlazados de la Universidad de Chile.

###Arquitectura
Para el funcionamiento del sitio se utilizaron un servidor con Virtuoso y otro con ElasticSearch (aparte de Apache). El primero se utiliza para disponer de un Endpoint SPARQL y de triplestore, en cambio el segundo
fue utilizado para mejorar las busquedas por textos y, por ende, para utilizar con el buscador en el front-end. 

###Configuración Apache
Se debe redirigir el sitio http://datos.uchile.cl/sparql al endpoint de Virtuoso (ejemplo http://localhost:8890/sparql). Por ende en la configuracion del VirtualHost hacer como proxy a él.

```
<Location /sparql>
     ProxyPass http://localhost:8890/sparql
     ProxyPassReverse http://localhost:8890/sparql
</Location>
```

Para que esto funcione se debe habilitar el modulo **proxy_http** con: 

```
a2enmod proxy_http
```

