NGINX

Docker... Gestión de contenedores
---------------------------------
    Kubernetes, Openshift, Podman
    
Contenedor?
    Un entorno de ejecución aislado en un SO anfitrión (Linux), donde ejecutamos procesos.
        - CPU
        - RAM
        - Red
Ventajas?
    AISLAMIENTO

Una aplicación virtual
    que usa en kernel de un SO anfitrión
    
    
APP1  | APP2    
------------
C1    |   C2
------------    
 Gestor de contenedores - Docker    
-----------
    SO
-----------
   Hierro
   
  
Imagen de contenedor?
    Archivo comprimido con unas carpetas y archivos
        Todo lo que me hace falta (excepto un kernel de SO) lo incluyo aquí.
    + Configuraciones
        -> Que proceso es el que quiero ejecutar
        -> Los puertos que estarán accesibles para los procesos que corren dentro del contenedor

Docker hub

docker pull nginx
docker images
docker container create --name ejemplo_nginx_1 -p 172.31.15.80:8080:80 nginx
docker container create --name ejemplo_nginx_1 -p 8080:80 nginx
docker start ejemplo_nginx_1

docker ps
docker container list
docker inspect ejemplo_nginx_1
docker rm ejemplo_nginx_1 -f
docker exec ejemplo_nginx_1 ls /

curl http://172.17.0.2:80
curl http://localhost:80

Alta disponibilidad:
Escalabilidad:
    > Cluster Activo/Pasivo <<<<<< 
    
    
    > Cluster Activo/Activo
    
    
    
Dia n    10   usuarios
Dia n    n+1  100k
Dia n+2  20   usuario
    

Volumenes:
    Carpeta/archivo que reside en el FS del host, y que monto dentro del FS del contenedor, con un path que yo decida

git <<< Linus Torwalds

docker container create --name ejemplo_nginx_1 -p 8080:80 \
    -v /home/ubuntu/environment/curso/configuraciones/miconfiguracion.ejemplo:/tmp/prueba.conf \
    nginx
    
    
---

Qué es nginx?
    - Un servidor web (esa es su característica principal) <
    - Proxy
    - Balanceador de carga

WEB?
    Un servicio que ofrecenmos a través de INTERNET
    Tim Berners-Lee <<< W3C ----   HTML + HTTP
        Genera los estandares que rigen el WEB: HTML, CSS, HTTP
            Lenguaje de marcado de información: HyperTextos
    Arquitectura web: Forma de montar apps de software que siguien el protocolo HTTP y se comunican mediante archivos HTML
        Arquitectura distribuida (Cliente(s) / Servidor)
    2 tipos de software :
        Cliente: Navegadores de Internet : Navegadores WEB
        Servidores: Apache, nginx
            Cual es la misión de estos servidores?
                Exponer unos archivos en una estructura de carpetas que cuelgan de una que identifico como raiz a través de HTTP
                Como opera el protocolo HTTP?
                    - Habitualmente usa el puerto 80
                    

Internet? HARDWARE + Protocolo IP > Internet Protocol
    tcp / ip
    udp
    Conjunto de redes descentralizadas que nos permiten conectar ordenadores, en ubicaciones geograficas diferentes
    Ofrecemos servicios:
        WEB
        Descarga de archivos
        Mail
        VoIP
    
Protocolo: Conjunto de reglas para establecer comunicaciones eficientes y efectivas



El servidor WEB quiere mandar un fichero a un cliente

Amazon quiere mandar un libro a un cliente
Que hace amazon, como se manda el libro?

    Caja
        -> Producto que he comprado
        ? viene algo más
            Pegatina:
                Datos: Nombre
                Dirección
                Fragil
                Peso

HTTP
    Mete lo que estoy mandando dentro de una caja: BODY 
    Pone una pegatina con valores:                 HEADERS
        Longitud del contenido
        Que es lo que mandan (el tipo de cosa)     mime-type
                                                        plain/txt
                                                        plain/html
                                                        image/jpeg
                                                        image/tif
                                                        application/pdf
        response code

La comunicación se divide en 2 partes/actos:
    El cliente comunica algo al servidor    REQUEST
        Metodos de cominicación: Method     : GET POST PUT DELETE HEAD
    El servidor responde al cliente         RESPONSE
        response code:              
            ###
            2XX                             Exito
            3XX                             Redirecciones
            4XX                             Error de cliente
            5XX                             Error de servidor
    
Al conectar con un servidor... para hacer una petición:
    URL:
        PROTO       SERVIDOR        PUERTO      RUTA                            PARAMETROS
        http   ://  amazon.es       :80         /index.html                     ? clave=valor & clave2=valor2
        https  ://  amazon.es       :443        /otracarpeta/fichero.pdf
            Mandar por red:
                HEADERS + BODY

http >>> https
    TLS 1 y 2(mTLS)
    
Que problema de seguridad pretende resolver HTTPS
    - No repudio (Firmar)
    - Man in the middle 
            <<< Encriptar los datos que se mandan 
    - Phishing                  Suplantación de identidad
        - DNI                       Policia Nacional
            nombre
            Quien me avala
        - Carnet de conducir        Trafico
        - Carnet de la biblioteca de mi barrio
        

Algoritmos para realizar encripciones/desencripciones:
    Algoritmos de clave simetrica
    Algoritmos de clave asimetrica 
        Pareja de claves: clave publica / clave privada 
        
Certificado <<< Entidad certificadora CA
    Fecha de expiracion
    CA : Quien lo expida
    Quien soy yo:
        Nombre del dominio
        Comodines
            *.amazon.es
        IP
    Clave publica

RSA
SHA - HASH - Huella


Cliente                     NGINX                                                           OTRO SERVICIO
                            clave privada                   https  (mTLS)                     Certificado
La CA X         https       <<< Certificado (clave publica) viene firmado por la CA X         private key
la tango que tener registrada... a ella o a alguien que la avale
                            Tenemos que dar de alta en nginx la que se confíe en la CA
                            
                            
mTLS? 

Con TLS me aseguro que el servidor es quien dice ser
Quien me asegura que el cliente es quien dice ser?
    Usuario y contraseña
    
Le exijo al cliente que presente el también su certificado 


kill <<< Mandar una señal a un proceso linux
kill -9 PID


NextCloud >>> Docker
                App Nextcloud
                librerias de sistemas
                Serv web (apache, nginx)

DNS 
amazon.es    1.2.3.4
compras.amazon.es    1.2.3.4
clientes.amazon.es    1.2.3.4



                    APP Que hace unas cosas
nginx            |              nginx    ---->          nginx php   Emergencias
                                                        nginx php   Emergencias
enrutando        |              nginx - balanceo ---->  tomcat   Java  Ropa
                                                 ---->  tomcat   Java  Ropa
                                      - servir contenido estático
                                    
                
                