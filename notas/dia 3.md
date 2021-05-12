------------------------------------------------
NGINX1 Pagina WEB 1: index.html (Soy la pagina web 1 desde el servidor 1)
NGINX2 Pagina WEB 1: index.html (Soy la pagina web 1 desde el servidor 2)

------------
Para conseguir alta disponibilidad HA en un entorno de producción, crearía al menos 2 contenedores con la misma app.
Por delante tendría que montar un balanceador de carga
-----------------------
LO QUE ESTAMOS HACIENDO
-----------------------
1º Creando un fichero docker compose con los 2 contenedores definidos.
    Arranco ese fichero en una maquina unica
2º Montar un nginx como balanceador.
-------------------------------
LO QUE HARIAMOS EN LA REALIDAD
-------------------------------
1º Creando un fichero docker compose con 1 contenedor unico definido.
    Arranco ese fichero en 2 maquinas distintas
2º Montar un nginx como balanceador.
-------------------------------
LO QUE PODRIAMOS HACER EN LA REALIDAD
-------------------------------
1º Creando un fichero similar a los de docker compose con 1 contenedor unico definido.
    Mandar eso a Kubernetes
------------

Voy a montar mi NGINX que da la cara a los clientes finales:
    Proxy reverso
    Balanceador
----------------

RUTAS DE ACCESO
              FRONTAL      BACKEND                  FUNCIONARIA?        ME GUSTA? 
sitio1        8085    >>>> 172.19.0.2:80                SI                  NO
                                                                            Si reinicio el contenedor que pasa con la IP?
sitio1        8085    >>>> sitio1:80                    SI                  Tampoco. Esta un poco mejor...
                                                                                Ya no estoy con IPs. Esto esta guay!
                                                                            Problema.
                                                                                Dónde va a estar ese contenedor?
                                                                                    Si está en otra máquina:
                                                                                        1- No tengo ni idea de como resolver ese nombre
                                                                                        2- Aunque lo resuelva, donde esta pinchado ese otro contenedor?
                                                                                            En un red diferente! del docker de la otra máquina
sitio1        8085    >>>> ip-172-31-15-80:8081         SI                  Más o menos
                                                                            Problema: 
                                                                                Seguridad >>> Expongo los servicios
                                                                                    Quizás los servicios no deben estar expuestos
                                                                                    Para eso he puesto el frontal

Docker swarm o Kubernetes       Crean una red privada entre las maquinas del cluster
                                Aqui dentro tengo dns


? Eso va a funcionar?
                                            Expongo esto en host/anfitrion
sitio1:  IP contenedor: 172.19.0.2:80            8081
app1_1:  IP Contenedor: 172.19.0.3:80            8082  |
app1_2:  IP Contenedor: 172.19.0.4:80            8083  |   Alta disponibilidad <<<< Quiero maquinas distintas, por definición.
frontal: IP Contenedor: 172.19.0.5:80            8085


HOST 1                              HOST 2
------------------------------------------------------------
Red Docker                          Red Docker independiente
 frontal
 app1_1:80 > 8082                     app1_2:80 > 8083
 
 
--------------------------------------------------------------
ALGORITMOS DE BALANCEO
                                    Escenarios de uso                                       VENTAJAS:          PROBLEMAS:
Round Robin                         - Peticiones que da igual donde se procesen               SENCILLO              Si tengo peticiones que NO da igual donde se procesen.... ESTO FALLA
                                    - Peticiones que a priori tardasen lo mismo entre si      RAPIDO-10             Si tengo peticiones que tarden distinto, no vale. No tiene en cuenta si un server está saturado
    Reparte como si reparto cartas

Least Connections                   - Peticiones que no tardan lo mismo entre si              RAPIDO-9
                                    - Peticiones que da igual donde se procesen               NO ES TAN SENCILLO
    Nginx lleva cuenta de las peticiones que aún no han sido respondidas por un servidor de backend

IP_HASH                             - Funciona bien cuando ya no de igual donde se procese una petición
                                        - Me redirige en base a la IP.
                                            - Cuantos más van a venir con la misma IP que yo?
                                                Que IP recibe nginx mia?
                                                    La de mi máquina? NO La del ROUTER
                                            Que mande a un servidor mogollon de peticiones y otro nada <<<<< PROBLEMON en según que escenario
                                    - No tiene en cuenta el tiempo.... Como las peticiones sean muy diferentes... me la puede liar
    Funciona en base al resto de dividir una huella calculada de la ip entre el numero de servidores
                                                                                            VENTAJAS: Es muy sencillo: Echar una división

sticky Sessions
        Trabajan en función de cookies. NGINX lleva control de que cookie va a cada servidor        
                Cada usuario irá a un sitio... pero en función de la cookie que presente.
                    Es esto sencillo para el nginx? NO,  Necesita más RAM para llevar esa tabla, y hacer más cuentas
                                

Peticion:
    APP1 - copia 1 - server 1
                        - En su RAM: el usuario 17 ha hecho login - Puedo tener muchas mas variables en la RAM: Un carrito de la compra
    APP1 - copia 2 - server 2
    
    Estado de la aplicación: Con las variables que tiene cargadas en su memoria RAM

Tengo una app, que requiere login?
    Que pasa cuando hago login en una app?
        TOMCAT app <<< login
        
        
        
--------
HASH: Huella 
Qué es una huella?
    Una representación del contenido original:
        - normalmente más sencilla, con menos información que el original
        - que siempre me devuelve el mismo valor para un contenidor original
        - Contener de alguna forma información sobre TODO el contenido original

HOLA AMIGO -> Quedarme con las primeras 4 letras -> HOLA
ADIOS AMIGO -> Quedarme con las primeras 4 letras -> ADIOS

10-11-2010 -> 2031 -> 6 ALGORITMO DE HUELLA COMPLETO
    LETRA DEL DNI
        12345678 -> 36 Resto de la divion entera entre 23
                36 / 23 = 1. RESTO = 13 => J

10.20.30.42 -> 100 % Número de servidores de backend / 1 = 50. RESTO? 0
               102  / 2                                 51            0

Jmeter <<<< Apache, Tomcat, httpd
    Hacer pruebas de cargas sobre un sistema: nginx