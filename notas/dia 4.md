frontal 1                               #### Servicios internos
    80: nginx: sitio1
    81: nginx: app1_1
        nginx: app1_2
    82: nextcloud
    http://servidor:80 >>> sitio1
    http://servidor:81 >>> app1

frontal 2:                              #### Servicios publicos : 1 unico nombre de dominio  : guardiacivil.es/
    80:/sitio1   nginx: sitio1
    80:/app1     nginx: app1_1
                 nginx: app1_2

    http://servidor:80/sitio1 >>> sitio1
    http://servidor:80/app1   >>> app1

frontal 3:                              #### Servicios publicos: Subdominios emergencias.guardiacivil.es ; notificaciones.guardiacivil.es
    80:   nginx: sitio1
    80:   nginx: app1_1
          nginx: app1_2

    http://sitio1.servidor:80   >>> sitio1      |
    http://app1.servidor:80     >>> app1        |   sitio1.servidor | sitio1   >>> IP de mi servidor
                                                |
    http://sitio1:80   >>> sitio1               |   app1.servidor | app1       >>> misma IP de mi servidor
    http://app1:80     >>> app1                 |

-----
Cannary deployment:
    - Tengo una app1v1 en un entorno de producción
    - Quiero montar la versión 2 de la aplicación en producción: app1v2

Voy a dejar la v1 en funcionamiento
Monto la version 2
Pongo las 2 versiones simultaneamente


app1v1   99% 95% peticiones                     |   75%     |   50%      |  0%
appav2    resto ... espero a ver que pasa       |   25%     |   50%      |  100%



-----
Cliente    >>> Frontal2 (/app1)   >>>> app1m1
Lenta      <<<     buffer         <<<<
-----
Buffer?
    Descativar buffer:    proxy_buffering: off;
                          proxy_buffers: 20 4k;
                          
                          
----
NEXT CLOUD:   CONTENEDORES                      PUERTO:
    c1: aplicacion propia de nextcloud            80  http/tcp    443 https
        servidor web nginx / apache           
    c2: base de datos                           3306  tcp
            mariaDB
----

Si veo un contenedor que expone los 2 puertos, eso que implica?
    Contenedor Expone el puerto 89, que yo puedo mapear ese puerto en el host
    Contenedor NO expone el puerto 89, que yo puedo mapear ese puerto en el host? 
EXPONER UN PUERTO EN UNA IMAGEN DE CONTENEDOR ES algo informacional. No tiene ningñun tipo de impacto a nivel de software.


----
http://IP_PUBLICA:8089 <<< Accedemos directos a NEXTCLOUD >> INSTALL
    Se ha apuntado que nombre de dominio estamos usando... y él lo añadió como dominio de confianza


http://IP_PUBLICA:8090   >>>> NGINX FRONTAL >>>>> http://ip-172-31-15-80:8089

----
App WEB
    Login >>>> IDENTIFICADOR DE SESSION: Espacio en memoria RAM que se reserva para un cliente que se está conectando con una APP WEB
                    COOKIE
                    
---- 
Tomcat: Servidor apps JAVA
    Compilacion
    Interpretados
    
        Compila > Interpreta
    
    Warm time
    
-----
500 workers
100ms

+5000 peticiones x seg a partir de ahi genero cola

peticiones muy lentas